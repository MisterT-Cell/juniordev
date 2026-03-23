<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\StudentProfile;

class StudentProfileController extends Controller
{
    public function edit()
    {
        $profile = auth()->user()->studentProfile ?? new StudentProfile();
        return view('student.profile.edit', compact('profile'));
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'phone' => 'nullable|string|max:20',
            'bio' => 'nullable|string|max:1000',
            'skills' => 'nullable|string|max:500',
            'region' => 'nullable|string|max:100',
            'education' => 'nullable|string|max:200',
        ]);

        auth()->user()->studentProfile()->updateOrCreate(
            ['user_id' => auth()->id()],
            $validated
        );

        return redirect()->route('student.profile.edit')->with('success', 'Profiel bijgewerkt!');
    }

    public function show($id)
    {
        $profile = StudentProfile::with('user')->findOrFail($id);
        return view('student.profile.show', compact('profile'));
    }
}
