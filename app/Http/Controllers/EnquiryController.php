<?php
namespace App\Http\Controllers;

use App\Http\Requests\EnquiryRequest;
use App\Models\Enquiry;
use App\Models\Country;
use App\Models\User;
use Illuminate\Http\Request;

class EnquiryController extends Controller
{
    public function index()
    {
        $enquiries = Enquiry::all();
        $title = 'Enquiries';

        return view('enquiries.index', compact('enquiries', 'title'));
    }

    public function create()
    {
        $countries = Country::all();
        $users = User::all();
        $title = "Create Enquiry";
        return view('enquiries.create',compact('countries','title'));
    }
    public function edit(Enquiry $enquiry)
    {
        $countries = Country::all();
        $users = User::all();
        $title = "Create Enquiry";
        return view('enquiries.edit', compact('enquiry','countries','title'));
    }


    public function destroy(Enquiry $enquiry)
    {
        $enquiry->delete();
        return redirect()->route('enquiries.index')->with('success', 'Enquiry deleted successfully!');
    }
    public function store(EnquiryRequest $request)
    {
        $data = $request->validated();

        $data['draft'] = $request->has('save_draft');
        $data['user_id'] = auth()->id();
        Enquiry::create($data);

        return redirect()->route('enquiries.index')->with('success', 'Enquiry saved successfully!');
    }

    public function update(Request $request, Enquiry $enquiry)
    {
        $data = $request->all();

        if ($request->has('update_owner')) {
            $enquiry->user_id = $request->input('file_owner');
        }

        $enquiry->update($data);

        return redirect()->route('enquiries.index')->with('success', 'Enquiry updated successfully!');
    }
}