<?php

namespace App\Http\Controllers;

use App\Http\Requests\EnquiryRequest;
use App\Models\Channel;
use App\Models\Country;
use App\Models\Enquiry;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EnquiryController extends Controller
{
    public function index()
    {
        $data['enquiries'] = Enquiry::all();

        return $this->extendedView('enquiry.index', $data, 'enquiries');
    }

    public function edit(Enquiry $enquiry)
    {
        $data['countries'] = Country::all();
        $data['users'] = User::all();
        $data['enquiry'] = $enquiry;
        $data['channels'] = Channel::all();

        return $this->extendedView('enquiry.edit', $data, 'Edit enquiry');
    }

    public function destroy(Enquiry $enquiry)
    {
        $enquiry->delete();

        return back()->with('flash_success', 'Enquiry deleted successfully.');
    }

    public function store(EnquiryRequest $request)
    {
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

    public function update(Request $request, Enquiry $enquiry)
    {
        logger($request->all());
        $data = $request->all();

        if ($request->has('update_owner')) {
            $enquiry->user_id = $request->input('file_owner');
        }

        $enquiry->update($data);

        return redirect()->route('enquiries.index')->with('flash_success', 'Enquiry updated successfully.');
    }
}
