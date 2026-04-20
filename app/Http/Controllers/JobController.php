<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Job;
use App\Models\Application;

class JobController extends Controller
{
    public function index(Request $request)
    {
        $query = Job::with('company.companyProfile')->where('status', 'open');

        if ($request->region) {
            $query->where('region', $request->region);
        }
        if ($request->type) {
            $query->where('type', $request->type);
        }
        if ($request->search) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }

        $jobs = $query->latest()->paginate(12);
        $regions = ['Groningen','Friesland','Drenthe','Overijssel','Flevoland','Gelderland','Utrecht','Noord-Holland','Zuid-Holland','Zeeland','Noord-Brabant','Limburg','Remote'];
        $types = Job::distinct()->pluck('type')->filter()->sort()->values();

        return view('jobs.index', compact('jobs', 'regions', 'types'));
    }

    public function show(Job $job)
    {
        $job->load('company.companyProfile', 'applications');
        $hasApplied = auth()->check()
            ? Application::where('job_id', $job->id)->where('user_id', auth()->id())->exists()
            : false;
        return view('jobs.show', compact('job', 'hasApplied'));
    }

    public function create()
    {
        return view('company.jobs.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title'        => 'required|string|max:200',
            'description'  => 'required|string',
            'type'         => 'required|string|max:100',
            'region'       => 'required|string|max:100',
            'requirements' => 'nullable|string',
        ]);

        $validated['user_id'] = auth()->id();
        Job::create($validated);

        return redirect()->route('company.jobs.index')->with('success', 'Vacature aangemaakt!');
    }

    public function edit(Job $job)
    {
        $this->authorize('update', $job);
        return view('company.jobs.edit', compact('job'));
    }

    public function update(Request $request, Job $job)
    {
        $this->authorize('update', $job);

        $validated = $request->validate([
            'title'        => 'required|string|max:200',
            'description'  => 'required|string',
            'type'         => 'required|string|max:100',
            'region'       => 'required|string|max:100',
            'requirements' => 'nullable|string',
            'status'       => 'required|in:open,closed',
        ]);

        $job->update($validated);
        return redirect()->route('company.jobs.index')->with('success', 'Vacature bijgewerkt!');
    }

    public function destroy(Job $job)
    {
        $this->authorize('delete', $job);
        $job->delete();
        return redirect()->route('company.jobs.index')->with('success', 'Vacature verwijderd!');
    }

    public function featured()
    {
        $jobs = Job::with('company.companyProfile')
            ->where('status', 'open')
            ->latest()
            ->take(6)
            ->get()
            ->map(fn($job) => [
                'id'          => $job->id,
                'title'       => $job->title,
                'description' => \Str::limit($job->description, 90),
                'type'        => $job->type,
                'region'      => $job->region,
                'company'     => $job->company->companyProfile->company_name ?? $job->company->name,
                'initial'     => strtoupper(substr($job->company->companyProfile->company_name ?? $job->company->name, 0, 1)),
                'url'         => route('jobs.show', $job),
            ]);

        return response()->json(['jobs' => $jobs]);
    }

    public function myJobs()
    {
        $jobs = Job::with('applications')
            ->where('user_id', auth()->id())
            ->latest()
            ->paginate(10);
        return view('company.jobs.index', compact('jobs'));
    }
}
