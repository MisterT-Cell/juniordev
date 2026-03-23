<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Assignment;
use App\Models\Application;
use App\Models\Message;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        if ($user->isStudent()) {
            $applications = Application::with('assignment.company.companyProfile')
                ->where('user_id', $user->id)
                ->latest()
                ->take(5)
                ->get();
            $latestAssignments = Assignment::with('company.companyProfile')
                ->where('status', 'open')
                ->latest()
                ->take(6)
                ->get();
            $unreadMessages = Message::where('receiver_id', $user->id)->whereNull('read_at')->count();
            return view('dashboard.student', compact('applications', 'latestAssignments', 'unreadMessages'));
        }

        if ($user->isCompany()) {
            $assignments = Assignment::with('applications')
                ->where('user_id', $user->id)
                ->latest()
                ->take(5)
                ->get();
            $pendingApplications = Application::whereHas('assignment', fn($q) => $q->where('user_id', $user->id))
                ->where('status', 'pending')
                ->count();
            $unreadMessages = Message::where('receiver_id', $user->id)->whereNull('read_at')->count();
            return view('dashboard.company', compact('assignments', 'pendingApplications', 'unreadMessages'));
        }

        if ($user->isAdmin()) {
            $stats = [
                'students' => \App\Models\User::where('role', 'student')->count(),
                'companies' => \App\Models\User::where('role', 'company')->count(),
                'assignments' => Assignment::count(),
                'applications' => Application::count(),
            ];
            return view('dashboard.admin', compact('stats'));
        }

        return redirect('/');
    }
}
