<?php

namespace App\Http\Controllers;

use App\Http\Requests\AccommodationRequest;
use App\Models\Accommodation;
use App\Models\AccommodationType;
use App\Models\HotelChain;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class AccommodationController extends Controller
{
    /**
     * Display a listing of accommodations.
     */
    public function index(): View
    {
        $this->authorize('view::accommodation');

        $data['accommodations'] = Accommodation::query()
            ->with(['hotelChain', 'accommodationType'])
            ->latest()
            ->get();
        $data['hotelChains'] = HotelChain::all();
        $data['accommodationTypes'] = AccommodationType::all();
        return $this->extendedView('accommodations.index', $data, 'accommodations');
    }

    /**
     * Show the form for creating a new accommodation.
     */
    public function create(): View
    {
        $this->authorize('create::accommodation');

        $data['hotelChains'] = HotelChain::all();
        $data['accommodationTypes'] = AccommodationType::all();
        $data['title'] = 'Create Accommodation';
        return $this->extendedView('accommodations.create', $data, 'create accommodation');
    }

    /**
     * Store a newly created accommodation in storage.
     */
    public function store(AccommodationRequest $request): RedirectResponse
    {
        $this->authorize('create::accommodation');

        try {
            $data = $request->validated();

            // Handle nested accommodation array from forms
            if (isset($data['accommodation'])) {
                $data = $data['accommodation'];
            }

            // Convert foreign keys to strings if they are integers
            if (isset($data['hotel_chain_id']) && is_numeric($data['hotel_chain_id'])) {
                $data['hotel_chain_id'] = (string)$data['hotel_chain_id'];
            }
            if (isset($data['accommodations_type_id']) && is_numeric($data['accommodations_type_id'])) {
                $data['accommodations_type_id'] = (string)$data['accommodations_type_id'];
            }

            // Auto-generate code if not provided
            if (empty($data['code'])) {
                $lastAccommodation = Accommodation::query()->latest('id')->first();
                $nextId = $lastAccommodation ? $lastAccommodation->id + 1 : 1;
                $data['code'] = str_pad($nextId, 4, '0', STR_PAD_LEFT);
            }

            // Set defaults for required database fields
            $data['hotel_chain_id'] = $data['hotel_chain_id'] ?? '';
            $data['accommodations_type_id'] = $data['accommodations_type_id'] ?? '';
            $data['address'] = $data['address'] ?? '';
            $data['city'] = $data['city'] ?? '';
            $data['country'] = $data['country'] ?? '';
            $data['phone'] = $data['phone'] ?? '';
            $data['email'] = $data['email'] ?? '';
            $data['website'] = $data['website'] ?? '';
            $data['camping_logistics'] = $data['camping_logistics'] ?? '';
            $data['balloon_pickup'] = $data['balloon_pickup'] ?? 'no';
            $data['voucher_copies'] = $data['voucher_copies'] ?? '3';
            $data['pay_to'] = $data['pay_to'] ?? 'hotel';
            $data['billing_ccy'] = $data['billing_ccy'] ?? 'USD';
            $data['coordinates'] = $data['coordinates'] ?? '';
            $data['status'] = $data['status'] ?? 'active';

            Accommodation::query()->create($data);

            return redirect()->route('accommodations.index')
                ->with('success', 'Accommodation created successfully.');
        } catch (Exception $e) {
            return redirect()->back()
                ->withInput()
                ->with('flash_error', 'Failed to create accommodation. Please try again.');
        }
    }

    /**
     * Display the specified accommodation.
     */
    public function show(Accommodation $accommodation): View
    {
        $this->authorize('view::accommodation');

        $data['accommodation'] = $accommodation->load(['hotelChain', 'accommodationType']);
        $data['title'] = 'Accommodation Details';
        return $this->extendedView('accommodations.show', $data, 'view accommodation');
    }

    /**
     * Show the form for editing the specified accommodation.
     */
    public function edit(Accommodation $accommodation): View
    {
        $this->authorize('edit::accommodation');

        $data['accommodation'] = $accommodation;
        $data['hotelChains'] = HotelChain::all();
        $data['accommodationTypes'] = AccommodationType::all();
        $data['title'] = 'Edit Accommodation';
        return $this->extendedView('accommodations.edit', $data, 'edit accommodation');
    }

    /**
     * Update the specified accommodation in storage.
     */
    public function update(AccommodationRequest $request, Accommodation $accommodation): RedirectResponse
    {
        $this->authorize('edit::accommodation');

        try {
            $data = $request->validated();

            // Handle nested accommodation array from forms
            if (isset($data['accommodation'])) {
                $data = $data['accommodation'];
            }

            // Convert foreign keys to strings if they are integers
            if (isset($data['hotel_chain_id']) && is_numeric($data['hotel_chain_id'])) {
                $data['hotel_chain_id'] = (string)$data['hotel_chain_id'];
            }
            if (isset($data['accommodations_type_id']) && is_numeric($data['accommodations_type_id'])) {
                $data['accommodations_type_id'] = (string)$data['accommodations_type_id'];
            }

            $accommodation->update($data);

            return redirect()->route('accommodations.index')
                ->with('success', 'Accommodation updated successfully.');
        } catch (Exception $e) {
            return redirect()->back()
                ->withInput()
                ->with('flash_error', 'Failed to update accommodation. Please try again.');
        }
    }

    /**
     * Remove the specified accommodation from storage.
     */
    public function destroy(Accommodation $accommodation): RedirectResponse
    {
        $this->authorize('delete::accommodation');

        try {
            $accommodation->delete();

            return redirect()->route('accommodations.index')
                ->with('success', 'Accommodation deleted successfully.');
        } catch (Exception $e) {
            return redirect()->back()
                ->with('flash_error', 'Failed to delete accommodation. Please try again.');
        }
    }
}
