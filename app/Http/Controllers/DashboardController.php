<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Job;
use App\Models\Application;
use App\Models\Message;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        if ($user->isStudent()) {
            $applications = Application::with('job.company.companyProfile')
                ->where('user_id', $user->id)
                ->latest()
                ->take(5)
                ->get();
            $latestJobs = Job::with('company.companyProfile')
                ->where('status', 'open')
                ->latest()
                ->take(6)
                ->get();
            $unreadMessages = Message::where('receiver_id', $user->id)->whereNull('read_at')->count();
            return view('dashboard.student', compact('applications', 'latestJobs', 'unreadMessages'));
        }

        if ($user->isCompany()) {
            $jobs = Job::with('applications')
                ->where('user_id', $user->id)
                ->latest()
                ->take(5)
                ->get();
            $pendingApplications = Application::whereHas('job', fn($q) => $q->where('user_id', $user->id))
                ->where('status', 'pending')
                ->count();
            $unreadMessages = Message::where('receiver_id', $user->id)->whereNull('read_at')->count();
            return view('dashboard.company', compact('jobs', 'pendingApplications', 'unreadMessages'));
        }

        if ($user->isAdmin()) {
            $stats = [
                'students'     => \App\Models\User::where('role', 'student')->count(),
                'companies'    => \App\Models\User::where('role', 'company')->count(),
                'jobs'         => Job::count(),
                'applications' => Application::count(),
            ];
            return view('dashboard.admin', compact('stats'));
        }

        return redirect('/');
    }
}
