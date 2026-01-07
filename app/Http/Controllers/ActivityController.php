<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreActivityRequest;
use App\Models\Activity;

class ActivityController extends Controller
{
    public function index()
    {
        $data['activities'] = Activity::all();

        return $this->extendedView('activities.index', $data, 'activities module');
    }

    public function store(StoreActivityRequest $request)
    {
        $validated = $request->validated();
        Activity::query()->create($validated);

        return back()->with('flash_success', 'Activity created successfully.');
    }

    public function create()
    {
        return back()->with('flash_error', 'Not found');
    }

    public function edit(Activity $activity)
    {
        return back()->with('flash_error', 'Not found');
    }

    public function update(StoreActivityRequest $request, Activity $activity)
    {
        $validated = $request->validated();
        $activity->update($validated);

        return back()->with('flash_success', 'Activity updated successfully.');
    }

    public function destroy(Activity $activity)
    {
        $activity->delete();

        return back()->with('flash_success', 'Activity deleted successfully.');
    }
}
