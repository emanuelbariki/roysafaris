<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreActivityRequest;
use App\Models\Activity;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class ActivityController extends Controller
{
    /**
     * Display a listing of activities.
     */
    public function index(): View
    {
        $this->authorize('view::activity');
        $data['activities'] = Activity::all();

        return $this->extendedView('activities.index', $data, 'activities module');
    }

    /**
     * Store a newly created activity in storage.
     */
    public function store(StoreActivityRequest $request): RedirectResponse
    {
        $this->authorize('create::activity');
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

    /**
     * Update the specified activity in storage.
     */
    public function update(StoreActivityRequest $request, Activity $activity): RedirectResponse
    {
        $this->authorize('edit::activity');
        $validated = $request->validated();
        $activity->update($validated);

        return back()->with('flash_success', 'Activity updated successfully.');
    }

    /**
     * Remove the specified activity from storage.
     */
    public function destroy(Activity $activity): RedirectResponse
    {
        $this->authorize('delete::activity');
        $activity->delete();

        return back()->with('flash_success', 'Activity deleted successfully.');
    }
}
