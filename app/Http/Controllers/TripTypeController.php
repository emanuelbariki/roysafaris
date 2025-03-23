<?php

namespace App\Http\Controllers;

use App\Models\TripType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class TripTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $tData['triptype'] = null;
        if ($request->has('edit')) {
            $tData['triptype'] = TripType::find($request->edit);
        }
        $tData['triptypes'] = TripType::all();

        $tData['title'] = "Trip Types";
        return view('masters.trip_types', $tData);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $exists = exists(TripType::class, $request->triptype);
        if (!$exists) {
            try {
                $triptype = $request->triptype;
                // $triptype['created_by'] = Auth::user()->id;

                TripType::create($triptype);
                return redirect()->route('triptypes.index')->with('success', 'Record added successfully!');
            } catch (\Throwable $th) {
                Log::error(message: $th->getMessage());

                return redirect()->route('triptypes.index')->with('error', 'An error occurred while adding the car brand.');
            }
        }

        return redirect()->route('triptypes.index')->with('error', 'Record already exists!');
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
    public function update(Request $request, $id)
    {
        //
        $TripType = TripType::findOrFail($id);
        
        $validatedData = $request->validate([
            'triptype.name' => 'required|string|max:255',
        ]);

        $triptype = $validatedData['triptype'];
        // $triptype['modified_by'] = Auth::id();

        $TripType->update($triptype);

        return redirect()->route('triptypes.index')->with('success', 'Record updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TripType $tripType)
    {
        //
    }
}
