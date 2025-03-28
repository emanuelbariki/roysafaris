<?php

namespace App\Http\Controllers;

use App\Models\Country;
use App\Models\NationalPark;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class NationalParkController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //
        $tData['nationalpark'] = null;
        if ($request->has('edit')) {
            $tData['nationalpark'] = NationalPark::find($request->edit);
        }
        $tData['nationalparks'] = NationalPark::all();
        $tData['countries'] = Country::all();

        $tData['title'] = "National Parks";
        return view('masters.national_parks', $tData);
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

        // dd($request->all());
        // Check if the brand already in db
        $exists = exists(NationalPark::class, $request->nationalpark);
        if (!$exists) {
            try {
                $nationalpark = $request->nationalpark;
                // $nationalpark['created_by'] = Auth::user()->id;

                $NationalPark = NationalPark::create($nationalpark);
                $NationalPark->update([
                    'code' => str_pad($NationalPark->id, 4, "0", STR_PAD_LEFT)
                ]);
                return redirect()->route('nationalparks.index')->with('success', 'Record added successfully!');
            } catch (\Throwable $th) {
                Log::error(message: $th->getMessage());

                return redirect()->route('nationalparks.index')->with('error', 'An error occurred while adding the car brand.');
            } 
        }

        return redirect()->route('nationalparks.index')->with('error', 'Record already exists!');
    }

    /**
     * Display the specified resource.
     */
    public function show(NationalPark $nationalPark)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(NationalPark $nationalPark)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        //
        $NationalPark = NationalPark::findOrFail($id);
        
        $validatedData = $request->validate([
            'nationalpark.name' => 'required|string|max:255',
        ]);

        $nationalpark = $validatedData['nationalpark'];
        // $nationalpark['modified_by'] = Auth::id();

        $NationalPark->update($nationalpark);

        return redirect()->route('nationalparks.index')->with('success', 'Record updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(NationalPark $nationalPark)
    {
        //
    }
}
