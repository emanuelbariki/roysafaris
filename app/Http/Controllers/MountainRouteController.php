<?php

namespace App\Http\Controllers;

use App\Http\Requests\MountainRouteRequest;
use App\Models\Mountain;
use App\Models\MountainRoute;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class MountainRouteController extends Controller
{
    /**
     * Display a listing of mountain routes.
     */
    public function index(): View
    {
        $this->authorize('view::mountainroute');

        $data['mountainroutes'] = MountainRoute::query()
            ->with('mountain')
            ->latest()
            ->get();
        $data['mountains'] = Mountain::all();
        return $this->extendedView('mountainroutes.index', $data, 'mountain routes');
    }

    /**
     * Show the form for creating a new mountain route.
     */
    public function create(): View
    {
        $this->authorize('create::mountainroute');

        $data['mountains'] = Mountain::all();
        $data['title'] = 'Create Mountain Route';
        return $this->extendedView('mountainroutes.create', $data, 'create mountain route');
    }

    /**
     * Store a newly created mountain route in storage.
     */
    public function store(MountainRouteRequest $request): RedirectResponse
    {
        $this->authorize('create::mountainroute');

        try {
            $data = $request->validated();

            // Auto-generate code if not provided
            if (empty($data['code'])) {
                $lastRoute = MountainRoute::query()->latest('id')->first();
                $nextId = $lastRoute ? $lastRoute->id + 1 : 1;
                $data['code'] = str_pad($nextId, 4, '0', STR_PAD_LEFT);
            }

            MountainRoute::query()->create($data);

            return redirect()->route('mountainroutes.index')
                ->with('success', 'Mountain route created successfully.');
        } catch (Exception $e) {
            return redirect()->back()
                ->withInput()
                ->with('flash_error', 'Failed to create mountain route. Please try again.');
        }
    }

    /**
     * Display the specified mountain route.
     */
    public function show(MountainRoute $mountainroute): View
    {
        $this->authorize('view::mountainroute');

        $data['mountainroute'] = $mountainroute->load('mountain');
        $data['title'] = 'Mountain Route Details';
        return $this->extendedView('mountainroutes.show', $data, 'view mountain route');
    }

    /**
     * Show the form for editing the specified mountain route.
     */
    public function edit(MountainRoute $mountainroute): View
    {
        $this->authorize('edit::mountainroute');

        $data['mountainroute'] = $mountainroute;
        $data['mountains'] = Mountain::all();
        $data['title'] = 'Edit Mountain Route';
        return $this->extendedView('mountainroutes.edit', $data, 'edit mountain route');
    }

    /**
     * Update the specified mountain route in storage.
     */
    public function update(MountainRouteRequest $request, MountainRoute $mountainroute): RedirectResponse
    {
        $this->authorize('edit::mountainroute');

        try {
            $mountainroute->update($request->validated());

            return redirect()->route('mountainroutes.index')
                ->with('success', 'Mountain route updated successfully.');
        } catch (Exception $e) {
            return redirect()->back()
                ->withInput()
                ->with('flash_error', 'Failed to update mountain route. Please try again.');
        }
    }

    /**
     * Remove the specified mountain route from storage.
     */
    public function destroy(MountainRoute $mountainroute): RedirectResponse
    {
        $this->authorize('delete::mountainroute');

        try {
            $mountainroute->delete();

            return redirect()->route('mountainroutes.index')
                ->with('success', 'Mountain route deleted successfully.');
        } catch (Exception $e) {
            return redirect()->back()
                ->with('flash_error', 'Failed to delete mountain route. Please try again.');
        }
    }
}
