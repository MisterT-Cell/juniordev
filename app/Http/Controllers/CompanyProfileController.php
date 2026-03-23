<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CompanyProfile;

class CompanyProfileController extends Controller
{
    public function edit()
    {
        $profile = auth()->user()->companyProfile ?? new CompanyProfile();
        return view('company.profile.edit', compact('profile'));
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'company_name' => 'required|string|max:200',
            'description' => 'nullable|string|max:2000',
            'website' => 'nullable|url|max:200',
            'region' => 'nullable|string|max:100',
            'phone' => 'nullable|string|max:20',
        ]);

        auth()->user()->companyProfile()->updateOrCreate(
            ['user_id' => auth()->id()],
            $validated
        );

        return redirect()->route('company.profile.edit')->with('success', 'Bedrijfsprofiel bijgewerkt!');
    }

    public function show($id)
    {
        $profile = CompanyProfile::with('user')->findOrFail($id);
        return view('company.profile.show', compact('profile'));
    }
}
