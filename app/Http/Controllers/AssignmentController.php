<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Assignment;
use App\Models\Application;

class AssignmentController extends Controller
{
    public function index(Request $request)
    {
        $query = Assignment::with('company.companyProfile')->where('status', 'open');

        if ($request->region) {
            $query->where('region', $request->region);
        }
        if ($request->type) {
            $query->where('type', $request->type);
        }
        if ($request->search) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }

        $assignments = $query->latest()->paginate(12);
        $regions = Assignment::distinct()->pluck('region')->filter()->sort()->values();
        $types = Assignment::distinct()->pluck('type')->filter()->sort()->values();

        return view('assignments.index', compact('assignments', 'regions', 'types'));
    }

    public function show(Assignment $assignment)
    {
        $assignment->load('company.companyProfile', 'applications');
        $hasApplied = auth()->check()
            ? Application::where('assignment_id', $assignment->id)->where('user_id', auth()->id())->exists()
            : false;
        return view('assignments.show', compact('assignment', 'hasApplied'));
    }

    public function create()
    {
        return view('company.assignments.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:200',
            'description' => 'required|string',
            'type' => 'required|string|max:100',
            'region' => 'required|string|max:100',
            'requirements' => 'nullable|string',
        ]);

        $validated['user_id'] = auth()->id();
        $assignment = Assignment::create($validated);

        return redirect()->route('company.assignments.index')->with('success', 'Opdracht aangemaakt!');
    }

    public function edit(Assignment $assignment)
    {
        $this->authorize('update', $assignment);
        return view('company.assignments.edit', compact('assignment'));
    }

    public function update(Request $request, Assignment $assignment)
    {
        $this->authorize('update', $assignment);

        $validated = $request->validate([
            'title' => 'required|string|max:200',
            'description' => 'required|string',
            'type' => 'required|string|max:100',
            'region' => 'required|string|max:100',
            'requirements' => 'nullable|string',
            'status' => 'required|in:open,closed',
        ]);

        $assignment->update($validated);
        return redirect()->route('company.assignments.index')->with('success', 'Opdracht bijgewerkt!');
    }

    public function destroy(Assignment $assignment)
    {
        $this->authorize('delete', $assignment);
        $assignment->delete();
        return redirect()->route('company.assignments.index')->with('success', 'Opdracht verwijderd!');
    }

    public function myAssignments()
    {
        $assignments = Assignment::with('applications')
            ->where('user_id', auth()->id())
            ->latest()
            ->paginate(10);
        return view('company.assignments.index', compact('assignments'));
    }
}
