<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        if ($user->role == 1) {
            return view('admin.profile.edit', ['user' => $user]);
        }

        return redirect()->route('guest.home', ['section' => 'profile'])->with('success', 'Profile updated successfully.');

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $rules = [
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $id,
        ];

        // Add password rules only if old_password is provided
        if ($request->filled('old_password') || $request->filled('password')) {
            $rules['old_password'] = 'required';
            $rules['password'] = 'required|min:8|confirmed';
        }

        $validated = $request->validate($rules);

        // Update name and email
        $user->name = $validated['name'];
        $user->email = $validated['email'];

        // If changing password, verify old password
        if ($request->filled('old_password')) {
            if (!Hash::check($request->old_password, $user->password)) {
                return back()->withErrors(['old_password' => 'Current password does not match.']);
            }

            $user->password = bcrypt($validated['password']);
        }

        $user->save();

        return redirect()->route('profile.edit', $user->id);
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
