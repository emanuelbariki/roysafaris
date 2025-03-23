<?php

namespace App\Http\Controllers;

use App\Models\Fleet;
use App\Models\FleetClass;
use App\Models\FleetType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class FleetController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //
        $tData['fleet'] = null;
        if ($request->has('edit')) {
            $tData['fleet'] = Fleet::find($request->edit);
        }
        $tData['fleettypes'] = FleetType::all();
        $tData['fleetclasses'] = FleetClass::all();
        $tData['fleets'] = Fleet::all();
        $tData['title'] = "Fleet";
        return view('masters.fleets', $tData);
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
        // Check if the brand already in db
        $fleet = $request->fleet;
        $exists = exists(Fleet::class, array('reg_no'=>$fleet['reg_no']));
        if (!$exists) {
            try {
                $fleet = $request->fleet;
                // dd($fleet);
                Fleet::create($fleet);
                return redirect()->route('fleets.index')->with('success', 'Record added successfully!');
            } catch (\Throwable $th) {
                Log::error(message: $th->getMessage());
                return redirect()->route('fleets.index')->with('error', 'An error occurred while adding the car brand.');
            }
        }

        return redirect()->route('fleets.index')->with('error', 'Record already exists!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Fleet $fleet)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Fleet $fleet)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Fleet $fleet)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Fleet $fleet)
    {
        //
    }
}
