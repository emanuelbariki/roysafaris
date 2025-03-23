<?php

namespace App\Http\Controllers;

use App\Models\FleetType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class FleetTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $tData['fleettype'] = null;
        if ($request->has('edit')) {
            $tData['fleettype'] = FleetType::find($request->edit);
        }
        $tData['fleettypes'] = FleetType::all();

        $tData['title'] = "Fleet Types";
        return view('masters.fleet_types', $tData);
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
        // Check if the brand already in db
        $exists = exists(FleetType::class, $request->fleettype);
        if (!$exists) {
            try {
                $fleettype = $request->fleettype;
                // $fleettype['created_by'] = Auth::user()->id;

                FleetType::create($fleettype);
                return redirect()->route('fleettypes.index')->with('success', 'Record added successfully!');
            } catch (\Throwable $th) {
                Log::error(message: $th->getMessage());

                return redirect()->route('fleettypes.index')->with('error', 'An error occurred while adding the car brand.');
            } 
        }

        return redirect()->route('fleettypes.index')->with('error', 'Record already exists!');
    }

    /**
     * Display the specified resource.
     */
    public function show(FleetType $fleetType)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(FleetType $fleetType)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $FleetType = FleetType::findOrFail($id);
        
        $validatedData = $request->validate([
            'fleettype.name' => 'required|string|max:255',
        ]);

        $fleettype = $validatedData['fleettype'];
        // $fleettype['modified_by'] = Auth::id();

        $FleetType->update($fleettype);

        return redirect()->route('fleettypes.index')->with('success', 'Record updated successfully!');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(FleetType $fleetType)
    {
        //
    }
}
