<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTripTypeRequest;
use App\Models\TripType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Throwable;

class TripTypeController extends Controller
{
    public function index(Request $request)
    {
        $data['tripTypes'] = TripType::all();

        return $this->extendedView('trip.type.index', $data, 'trip types');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTripTypeRequest $request)
    {
        try {
            $validated = $request->validated();

            TripType::create($validated);

            return redirect()
                ->route('triptypes.index')
                ->with('success', 'Trip type created successfully.');
        } catch (Throwable $e) {
            Log::error('Error creating trip type: '.$e->getMessage(), [
                'exception' => $e,
            ]);

            return redirect()
                ->route('triptypes.index')
                ->with('error', 'An error occurred while creating the trip type.');
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(TripType $tripType)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(TripType $tripType)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreTripTypeRequest $request, $id)
    {
        try {
            $validated = $request->validated();
            $tripType = TripType::findOrFail($id);

            $tripType->update($validated);

            return redirect()
                ->route('triptypes.index')
                ->with('success', 'Trip type updated successfully!');
        } catch (Throwable $e) {
            Log::error('Error updating trip type: '.$e->getMessage(), [
                'exception' => $e,
            ]);

            return redirect()
                ->route('triptypes.index')
                ->with('error', 'An error occurred while updating the trip type.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $tripType = TripType::findOrFail($id);
            $tripType->delete();

            return redirect()
                ->route('triptypes.index')
                ->with('success', 'Trip type deleted successfully!');
        } catch (Throwable $e) {
            Log::error('Error deleting trip type: '.$e->getMessage(), [
                'exception' => $e,
            ]);

            return redirect()
                ->route('triptypes.index')
                ->with('error', 'An error occurred while deleting the trip type.');
        }
    }
}
