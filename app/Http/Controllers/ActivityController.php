<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use Illuminate\Http\Request;
use App\Http\Requests\ActivityRequest;

class ActivityController extends Controller
{
    public function index()
    {
        $activities = Activity::all();
        $title = "Activities Module";
        return view('activities.index', compact('activities', 'title'));
    }

    public function create()
    {
        // Passing an empty variable for create
        return view('activities.form',[
            'title' => 'Create Activities',
        ]);
    }

    public function store(ActivityRequest $request)
    {
        // Validated data from the request
        $validated = $request->validated();
        // Create the activity
        Activity::create($validated);

        return redirect()->route('activities.index')->with('success', 'Activity created successfully.');
    }

    public function edit(Activity $activity)
    {
        // Pass the existing activity to the form view for editing
        $title = "Edit Activity";
        return view('activities.form', compact('activity', 'title'));
    }

    public function update(ActivityRequest $request, Activity $activity)
    {
        // Validated data from the request
        $validated = $request->validated();

        // Update the activity
        $activity->update($validated);

        return redirect()->route('activities.index')->with('success', 'Activity updated successfully.');
    }

    public function destroy(Activity $activity)
    {
        $activity->delete();

        return redirect()->route('activities.index')->with('success', 'Activity deleted successfully.');
    }
}
