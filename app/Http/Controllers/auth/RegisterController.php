<?php

// app/Http/Controllers/Auth/RegisterController.php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class RegisterController extends Controller
{

    public function register(Request $request)
    {
        $request->validate([
            'name'                  => 'required|string|max:255',
            'email'                 => 'required|string|email|max:255|unique:users',
            'password'              => 'required|string|min:6|confirmed',
            'role'                  => 'required|exists:roles,id',
        ]);

        $role = Role::find($request->role);

        if ($role && strtolower($role->name) === 'reviewer') {
            $request->validate([
                'field' => 'required|array|min:1',
                'field.*' => 'string|max:255',
                'qualification' => 'required|string',
                'institute_name' => 'required|string',
                'user_prefix_id' => 'required',
                'phone' => 'required',
                'cv_form' => 'required|file|mimes:pdf,doc,docx|max:5048',
                'latest_qualification' => 'required|file|mimes:pdf,doc,docx|max:5048',
            ]);
        } elseif ($role && strtolower($role->name) === 'author') {
            $request->validate([
                'position' => 'required|string|max:255',
                'department' => 'required|string|max:255',
                'organization' => 'required|string|max:255',
            ]);
        }

        // Prepare field string (comma-separated) if role is reviewer
        $fieldString = null;
        if ($request->has('field')) {
            $fieldString = implode(',', $request->field);
        }

        $cv_path = null;
        $latest_qualification_path = null;

        if ($request->cv_form) {
            $cv_path = Storage::disk('public')->put('reviewer_cv', $request->cv_form);
        }

        if ($request->latest_qualification) {
            $latest_qualification_path = Storage::disk('public')->put('reviewer_latest_qualification', $request->latest_qualification);
        }

        $user = User::create([
            'name'                 => $request->name,
            'email'                => $request->email,
            'password'             => Hash::make($request->password),
            //author
            'position'             => $request->position,
            'department'           => $request->department,
            'organization'         => $request->organization,
            //reviewer
            'user_prefix_id'       => $request->user_prefix_id,
            'qualification'        => $request->qualification,
            'institute_name'       => $request->institute_name,
            'phone'                => $request->phone,
            'field'                => $fieldString,
            'cv_form'              => $cv_path,
            'latest_qualification' => $latest_qualification_path,
        ]);

        if ($role) {
            $user->roles()->attach($role->id);
        }

        // If reviewer, do NOT auto-login and show info to wait for approval
        if ($role && strtolower($role->name) === 'reviewer') {
            return redirect()->route('guest.home', ['section' => 'login'])
                ->with('info', 'Registration successful! Please wait for admin approval.');
        }

        // Auto-login other roles
        Auth::login($user);

        // Redirect after login based on role
        if (Auth::user()->roles->contains('name', 'admin')) {
            return redirect()->intended('/dashboard')->with('success', 'Registration successful!');
        } else {
            return redirect()->intended('/')->with('success', 'Registration successful!');
        }
    }
}
