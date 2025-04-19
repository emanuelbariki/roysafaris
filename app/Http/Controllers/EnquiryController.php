<?php
namespace App\Http\Controllers;

use App\Http\Requests\EnquiryRequest;
use App\Models\Channel;
use App\Models\Enquiry;
use App\Models\Country;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        $channels = Channel::all();

        return view('enquiries.create',compact('countries','title', 'users','channels'));

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
        // $data = $request->validated(); // Commented for noe
        $data = $request->all();
        // dd($data);
        $data['draft'] = $request->has('save_draft');
        $data['user_id'] = Auth::user()->id;
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