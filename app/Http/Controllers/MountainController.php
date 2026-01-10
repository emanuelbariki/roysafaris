<?php

namespace App\Http\Controllers;

use App\Http\Requests\MountainRequest;
use App\Models\Mountain;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class MountainController extends Controller
{
    /**
     * Display a listing of mountains.
     */
    public function index(): View
    {
        $this->authorize('view::mountain');

        $data['mountains'] = Mountain::query()->latest()->get();
        return $this->extendedView('mountains.index', $data, 'mountains');
    }

    /**
     * Show the form for creating a new mountain.
     */
    public function create(): View
    {
        $this->authorize('create::mountain');

        $data['title'] = 'Create Mountain';
        return $this->extendedView('mountains.create', $data, 'create mountain');
    }

    /**
     * Store a newly created mountain in storage.
     */
    public function store(MountainRequest $request): RedirectResponse
    {
        $this->authorize('create::mountain');

        try {
            $data = $request->validated();

            // Auto-generate code if not provided
            if (empty($data['code'])) {
                $lastMountain = Mountain::query()->latest('id')->first();
                $nextId = $lastMountain ? $lastMountain->id + 1 : 1;
                $data['code'] = str_pad($nextId, 4, '0', STR_PAD_LEFT);
            }

            Mountain::query()->create($data);

            return redirect()->route('mountains.index')
                ->with('success', 'Mountain created successfully.');
        } catch (Exception $e) {
            return redirect()->back()
                ->withInput()
                ->with('flash_error', 'Failed to create mountain. Please try again.');
        }
    }

    /**
     * Display the specified mountain.
     */
    public function show(Mountain $mountain): View
    {
        $this->authorize('view::mountain');

        $data['mountain'] = $mountain;
        $data['title'] = 'Mountain Details';
        return $this->extendedView('mountains.show', $data, 'view mountain');
    }

    /**
     * Show the form for editing the specified mountain.
     */
    public function edit(Mountain $mountain): View
    {
        $this->authorize('edit::mountain');

        $data['mountain'] = $mountain;
        $data['title'] = 'Edit Mountain';
        return $this->extendedView('mountains.edit', $data, 'edit mountain');
    }

    /**
     * Update the specified mountain in storage.
     */
    public function update(MountainRequest $request, Mountain $mountain): RedirectResponse
    {
        $this->authorize('edit::mountain');

        try {
            $mountain->update($request->validated());

            return redirect()->route('mountains.index')
                ->with('success', 'Mountain updated successfully.');
        } catch (Exception $e) {
            return redirect()->back()
                ->withInput()
                ->with('flash_error', 'Failed to update mountain. Please try again.');
        }
    }

    /**
     * Remove the specified mountain from storage.
     */
    public function destroy(Mountain $mountain): RedirectResponse
    {
        $this->authorize('delete::mountain');

        try {
            $mountain->delete();

            return redirect()->route('mountains.index')
                ->with('success', 'Mountain deleted successfully.');
        } catch (Exception $e) {
            return redirect()->back()
                ->with('flash_error', 'Failed to delete mountain. Please try again.');
        }
    }
}
