<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Application;
use App\Models\Job;
use App\Notifications\ApplicationReceived;
use App\Notifications\ApplicationStatusChanged;

class ApplicationController extends Controller
{
    public function store(Request $request, Job $job)
    {
        if ($job->status === 'closed') {
            return back()->with('error', 'Deze vacature is gesloten.');
        }

        $exists = Application::where('job_id', $job->id)
            ->where('user_id', auth()->id())
            ->exists();

        if ($exists) {
            return back()->with('error', 'Je hebt al gereageerd op deze vacature.');
        }

        $validated = $request->validate([
            'motivation' => 'required|string|min:50|max:2000',
        ]);

        $application = Application::create([
            'job_id'     => $job->id,
            'user_id'    => auth()->id(),
            'motivation' => $validated['motivation'],
        ]);

        $job->company->notify(new ApplicationReceived($application));

        return redirect()->route('student.applications.index')->with('success', 'Reactie verstuurd!');
    }

    public function studentIndex()
    {
        $applications = Application::with('job.company.companyProfile')
            ->where('user_id', auth()->id())
            ->latest()
            ->paginate(10);
        return view('student.applications.index', compact('applications'));
    }

    public function companyIndex(Job $job)
    {
        $this->authorize('view', $job);
        $applications = Application::with('student.studentProfile')
            ->where('job_id', $job->id)
            ->latest()
            ->paginate(10);
        return view('company.applications.index', compact('applications', 'job'));
    }

    public function updateStatus(Request $request, Application $application)
    {
        $this->authorize('update', $application);

        $validated = $request->validate([
            'status' => 'required|in:accepted,rejected',
        ]);

        $application->update($validated);
        $application->student->notify(new ApplicationStatusChanged($application));

        return back()->with('success', 'Status bijgewerkt!');
    }
}
