<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\RegistrationInfo;
use Illuminate\Http\Request;

class RegistrationInfoController extends Controller
{
    public function index()
    {
        $infos = RegistrationInfo::all();
        return view('admin.fees.index', compact('infos'));
    }

    public function create()
    {
        return view('admin.fees.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'type' => 'required|in:fee,email',
            'label' => 'required|string|max:255',
            'value' => 'required|string|max:255',
        ]);

        RegistrationInfo::create($request->only('type', 'label', 'value'));

        return redirect()->route('admin.fees.index')->with('success', 'Info added successfully.');
    }

    public function edit($id)
    {
        $info = RegistrationInfo::findOrFail($id);
        return view('admin.fees.edit', compact('info'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'type' => 'required|in:fee,email',
            'label' => 'required|string|max:255',
            'value' => 'required|string|max:255',
        ]);

        $info = RegistrationInfo::findOrFail($id);
        $info->update($request->only('type', 'label', 'value'));

        return redirect()->route('admin.fees.index')->with('success', 'Info updated successfully.');
    }

    public function destroy($id)
    {
        $info = RegistrationInfo::findOrFail($id);
        $info->delete();

        return redirect()->route('admin.fees.index')->with('success', 'Info deleted successfully.');
    }
}
