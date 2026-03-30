<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Job;
use App\Models\Application;

class AdminController extends Controller
{
    public function users(Request $request)
    {
        $query = User::with('studentProfile', 'companyProfile');
        if ($request->role) $query->where('role', $request->role);
        if ($request->search) $query->where('name', 'like', '%'.$request->search.'%');
        $users = $query->latest()->paginate(20);
        return view('admin.users', compact('users'));
    }

    public function toggleBlock(User $user)
    {
        $user->update(['is_blocked' => !$user->is_blocked]);
        $status = $user->is_blocked ? 'geblokkeerd' : 'gedeblokkeerd';
        return back()->with('success', "Gebruiker {$status}!");
    }

    public function destroyUser(User $user)
    {
        $user->delete();
        return back()->with('success', 'Gebruiker verwijderd!');
    }

    public function jobs(Request $request)
    {
        $jobs = Job::with('company.companyProfile')->latest()->paginate(20);
        return view('admin.jobs', compact('jobs'));
    }

    public function destroyJob(Job $job)
    {
        $job->delete();
        return back()->with('success', 'Vacature verwijderd!');
    }
}
