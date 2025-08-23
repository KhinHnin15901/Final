<?php

namespace App\Http\Controllers;

use App\Models\JournalReview;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PublishController extends Controller
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
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, JournalReview $publish)
    {
        $request->validate([
           'kpay_receipt' => 'required|file|mimes:jpg,png,jpeg|max:5048',
        ]);

        $kpay_path = Storage::disk('public')->put('kpay_receipt', $request->kpay_receipt);

        $publish->update([
            'kpay_receipt' => $kpay_path,
            'evaluation' => 'publish_draft',
            'status' => 'draft',
        ]);

        return redirect()->route('guest.home', ['section' => 'events'])
                ->with('success', 'Publish Request Sent Successfully. Please wait for admin approval.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
