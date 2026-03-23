<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Application;
use App\Models\Assignment;
use App\Notifications\ApplicationReceived;
use App\Notifications\ApplicationStatusChanged;

class ApplicationController extends Controller
{
    public function store(Request $request, Assignment $assignment)
    {
        if ($assignment->status === 'closed') {
            return back()->with('error', 'Deze opdracht is gesloten.');
        }

        $exists = Application::where('assignment_id', $assignment->id)
            ->where('user_id', auth()->id())
            ->exists();

        if ($exists) {
            return back()->with('error', 'Je hebt al gereageerd op deze opdracht.');
        }

        $validated = $request->validate([
            'motivation' => 'required|string|min:50|max:2000',
        ]);

        $application = Application::create([
            'assignment_id' => $assignment->id,
            'user_id' => auth()->id(),
            'motivation' => $validated['motivation'],
        ]);

        // Notify company
        $assignment->company->notify(new ApplicationReceived($application));

        return redirect()->route('student.applications.index')->with('success', 'Reactie verstuurd!');
    }

    public function studentIndex()
    {
        $applications = Application::with('assignment.company.companyProfile')
            ->where('user_id', auth()->id())
            ->latest()
            ->paginate(10);
        return view('student.applications.index', compact('applications'));
    }

    public function companyIndex(Assignment $assignment)
    {
        $this->authorize('view', $assignment);
        $applications = Application::with('student.studentProfile')
            ->where('assignment_id', $assignment->id)
            ->latest()
            ->paginate(10);
        return view('company.applications.index', compact('applications', 'assignment'));
    }

    public function updateStatus(Request $request, Application $application)
    {
        $this->authorize('update', $application);

        $validated = $request->validate([
            'status' => 'required|in:accepted,rejected',
        ]);

        $application->update($validated);

        // Notify student
        $application->student->notify(new ApplicationStatusChanged($application));

        return back()->with('success', 'Status bijgewerkt!');
    }
}
