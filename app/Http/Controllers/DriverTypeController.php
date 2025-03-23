<?php

namespace App\Http\Controllers;

use App\Models\DriverType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class DriverTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //
        
        $tData['drivertype'] = null;
        if ($request->has('edit')) {
            $tData['drivertype'] = DriverType::find($request->edit);
        }
        $tData['drivertypes'] = DriverType::all();
        $tData['title'] = "Driver Types";
        return view('masters.driver_types', $tData);
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
        $exists = exists(DriverType::class, $request->drivertype);
        if (!$exists) {
            try {
                $drivertype = $request->drivertype;
                DriverType::create($drivertype);
                return redirect()->route('drivertypes.index')->with('success', 'Record added successfully!');
            } catch (\Throwable $th) {
                Log::error(message: $th->getMessage());
                return redirect()->route('drivertypes.index')->with('error', 'An error occurred while adding the car brand.');
            }
        }

        return redirect()->route('drivertypes.index')->with('error', 'Record already exists!');
    }

    /**
     * Display the specified resource.
     */
    public function show(DriverType $driverType)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(DriverType $driverType)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        //
        //
        $DriverTypes = DriverType::findOrFail($id);
        
        $validatedData = $request->validate([
            'drivertype.name' => 'required|string|max:255',
        ]);

        $drivertype = $validatedData['drivertype'];
        // $drivertype['modified_by'] = Auth::id();

        $DriverTypes->update($drivertype);

        return redirect()->route('drivertypes.index')->with('success', 'Record updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DriverType $driverType)
    {
        //
    }
}
