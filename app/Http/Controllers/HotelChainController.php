<?php

namespace App\Http\Controllers;

use App\Http\Requests\HotelChainRequest;
use App\Models\HotelChain;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class HotelChainController extends Controller
{
    /**
     * Display a listing of hotel chains.
     */
    public function index(): View
    {
        $this->authorize('view::hotelchain');

        $data['hotelchains'] = HotelChain::query()->latest()->get();
        return $this->extendedView('hotelchains.index', $data, 'hotel chains');
    }

    /**
     * Show the form for creating a new hotel chain.
     */
    public function create(): View
    {
        $this->authorize('create::hotelchain');

        $data['title'] = 'Create Hotel Chain';
        return $this->extendedView('hotelchains.create', $data, 'create hotel chain');
    }

    /**
     * Store a newly created hotel chain in storage.
     */
    public function store(HotelChainRequest $request): RedirectResponse
    {
        $this->authorize('create::hotelchain');

        try {
            $data = $request->validated();

            // Auto-generate code if not provided
            if (empty($data['code'])) {
                $lastChain = HotelChain::query()->latest('id')->first();
                $nextId = $lastChain ? $lastChain->id + 1 : 1;
                $data['code'] = str_pad($nextId, 4, '0', STR_PAD_LEFT);
            }

            HotelChain::query()->create($data);

            return redirect()->route('hotelchains.index')
                ->with('success', 'Hotel chain created successfully.');
        } catch (Exception $e) {
            return redirect()->back()
                ->withInput()
                ->with('flash_error', 'Failed to create hotel chain. Please try again.');
        }
    }

    /**
     * Display the specified hotel chain.
     */
    public function show(HotelChain $hotelchain): View
    {
        $this->authorize('view::hotelchain');

        $data['hotelchain'] = $hotelchain;
        $data['title'] = 'Hotel Chain Details';
        return $this->extendedView('hotelchains.show', $data, 'view hotel chain');
    }

    /**
     * Show the form for editing the specified hotel chain.
     */
    public function edit(HotelChain $hotelchain): View
    {
        $this->authorize('edit::hotelchain');

        $data['hotelchain'] = $hotelchain;
        $data['title'] = 'Edit Hotel Chain';
        return $this->extendedView('hotelchains.edit', $data, 'edit hotel chain');
    }

    /**
     * Update the specified hotel chain in storage.
     */
    public function update(HotelChainRequest $request, HotelChain $hotelchain): RedirectResponse
    {
        $this->authorize('edit::hotelchain');

        try {
            $hotelchain->update($request->validated());

            return redirect()->route('hotelchains.index')
                ->with('success', 'Hotel chain updated successfully.');
        } catch (Exception $e) {
            return redirect()->back()
                ->withInput()
                ->with('flash_error', 'Failed to update hotel chain. Please try again.');
        }
    }

    /**
     * Remove the specified hotel chain from storage.
     */
    public function destroy(HotelChain $hotelchain): RedirectResponse
    {
        $this->authorize('delete::hotelchain');

        try {
            $hotelchain->delete();

            return redirect()->route('hotelchains.index')
                ->with('success', 'Hotel chain deleted successfully.');
        } catch (Exception $e) {
            return redirect()->back()
                ->with('flash_error', 'Failed to delete hotel chain. Please try again.');
        }
    }
}
