<?php

namespace App\Http\Controllers;

use App\Http\Requests\EnquiryRequest;
use App\Models\Channel;
use App\Models\Country;
use App\Models\Enquiry;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class EnquiryController extends Controller
{
    /**
     * Display a listing of enquiries.
     */
    public function index(): View
    {
        $this->authorize('view::enquiry');
        $data['enquiries'] = Enquiry::all();

        return $this->extendedView('enquiry.index', $data, 'enquiries');
    }

    /**
     * Show the form for editing the specified enquiry.
     */
    public function edit(Enquiry $enquiry): View
    {
        $this->authorize('edit::enquiry');
        $data['countries'] = Country::all();
        $data['users'] = User::all();
        $data['enquiry'] = $enquiry;
        $data['channels'] = Channel::all();

        return $this->extendedView('enquiry.edit', $data, 'Edit enquiry');
    }

    /**
     * Remove the specified enquiry from storage.
     */
    public function destroy(Enquiry $enquiry): RedirectResponse
    {
        $this->authorize('delete::enquiry');
        $enquiry->delete();

        return back()->with('flash_success', 'Enquiry deleted successfully.');
    }

    /**
     * Store a newly created enquiry in storage.
     */
    public function store(EnquiryRequest $request): RedirectResponse
    {
        $this->authorize('create::enquiry');
        $data = $request->all();
        $data['draft'] = $request->has('save_draft');
        $data['user_id'] = Auth::user()->id;
        Enquiry::query()->create($data);

        return redirect()->route('enquiries.index')->with('flash_success', 'Enquiry saved successfully.');
    }

    public function create()
    {
        $data['countries'] = Country::all();
        $data['users'] = User::all();
        $data['channels'] = Channel::all();

        return $this->extendedView('enquiry.create', $data, 'Create Enquiry');
    }

    /**
     * Update the specified enquiry in storage.
     */
    public function update(Request $request, Enquiry $enquiry): RedirectResponse
    {
        $this->authorize('edit::enquiry');
        logger($request->all());
        $data = $request->all();

        if ($request->has('update_owner')) {
            $enquiry->user_id = $request->input('file_owner');
        }

        $enquiry->update($data);

        return redirect()->route('enquiries.index')->with('flash_success', 'Enquiry updated successfully.');
    }
}
