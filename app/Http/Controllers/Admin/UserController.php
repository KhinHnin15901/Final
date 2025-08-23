<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\JournalSubmission;
use App\Models\User;
use App\Models\ReviewSchedule;
use App\Models\UserPrefix;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function reviewer()
    {
        $reviewers = User::whereHas('roles', function ($query) {
            $query->where('name', 'reviewer');
        })->get();
        return view('admin.user.userlist', compact('reviewers'));
    }
    public function author()
    {
        $authors = User::whereHas('roles', function ($query) {
            $query->where('name', 'author');
        })->get();
        return view('admin.user.authorlist', compact('authors'));
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        $user_prefixes = UserPrefix::get();
        // Return an edit view with user data
        return view('admin.user.edit', compact('user', 'user_prefixes'));
    }

    // Update user info
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $validate_fields = [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $id,
        ];

        if ($user->roles()->first()->name === 'author') {
            $validate_fields += [
                'address' => 'nullable|string|max:255',
                'position' => 'nullable|string|max:255',
                'department' => 'nullable|string|max:255',
            ];
        } elseif ($user->roles()->first()->name === 'reviewer') {
            $validate_fields += [
                'field' => 'required',
                'qualification' => 'required|string',
                'institute_name' => 'required|string',
                'user_prefix_id' => 'required',
                'phone' => 'required',
                'cv_form' => 'nullable|file|mimes:pdf,doc,docx|max:5048', // Changed to nullable
                'latest_qualification' => 'nullable|file|mimes:pdf,doc,docx|max:5048', // Changed to nullable
            ];
        }

        $validated = $request->validate($validate_fields);

        // Handle CV upload
        if ($request->hasFile('cv_form')) {
            // Delete old CV if exists
            if ($user->cv_form && Storage::disk('public')->exists($user->cv_form)) {
                Storage::disk('public')->delete($user->cv_form);
            }
            $validated['cv_form'] = Storage::disk('public')->put('reviewer_cv', $request->cv_form);
        } else {
            $validated['cv_form'] = $user->cv_form; // Keep old
        }

        // Handle Latest Qualification upload
        if ($request->hasFile('latest_qualification')) {
            // Delete old file if exists
            if ($user->latest_qualification && Storage::disk('public')->exists($user->latest_qualification)) {
                Storage::disk('public')->delete($user->latest_qualification);
            }
            $validated['latest_qualification'] = Storage::disk('public')->put('reviewer_latest_qualification', $request->latest_qualification);
        } else {
            $validated['latest_qualification'] = $user->latest_qualification; // Keep old
        }

        $user->update($validated);

        return redirect()->back()->with('success', 'User updated successfully.');
    }

    // Delete user
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        if ($user->cv_form) {
            Storage::disk('public')->delete($user->cv_form);
        }

        if ($user->latest_qualification) {
            Storage::disk('public')->delete($user->latest_qualification);
        }

        $user->delete();

        return redirect()->back()->with('success', 'User deleted successfully!');
    }

    // Your custom 'approach' action (modify as needed)
    public function approach($id)
    {
        $user = User::findOrFail($id);
        if ($user->email_verified_at != null) {
            $user->email_verified_at = null;
            $user->save();
            // For demonstration, just redirect back with success message
            return redirect()->back()->with('success', "DisApproved user {$user->name} successfully!");
        }
        // Perform some action, e.g., mark as approached or send notification
        // Example: $user->approached = true; $user->save();

        else {
            $user->email_verified_at = now();
            $user->save();
            // For demonstration, just redirect back with success message
            return redirect()->back()->with('success', "Approved user {$user->name} successfully!");
        }
    }
}
