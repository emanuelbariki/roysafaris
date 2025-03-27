<?php

namespace App\Http\Controllers;

use App\Models\Mountain;
use App\Models\MountainRoute;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class MountainRouteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //
        
        $tData['mountainroute'] = null;
        if ($request->has('edit')) {
            $tData['mountainroute'] = MountainRoute::find($request->edit);
        }
        $tData['mountainroutes'] = MountainRoute::all();
        $tData['mountains'] = Mountain::all();
        $tData['title'] = "Mountain Routes";
        return view('masters.mountain_routes', $tData);
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
        $exists = exists(MountainRoute::class, $request->mountainroute);
        if (!$exists) {
            try {
                $mountainroute = $request->mountainroute;
                $MountainRoute = MountainRoute::create($mountainroute);

                $MountainRoute->update([
                    'code' => str_pad($MountainRoute->id, 4, "0", STR_PAD_LEFT)
                ]);

                return redirect()->route('mountainroutes.index')->with('success', 'Record added successfully!');
            } catch (\Throwable $th) {
                Log::error(message: $th->getMessage());
                return redirect()->route('mountainroutes.index')->with('error', 'An error occurred while adding the car brand.');
            }
        }

        return redirect()->route('mountainroutes.index')->with('error', 'Record already exists!');
    }

    /**
     * Display the specified resource.
     */
    public function show(MountainRoute $driverType)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(MountainRoute $driverType)
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
        $MountainRoutes = MountainRoute::findOrFail($id);
        
        $validatedData = $request->validate([
            'mountainroute.name' => 'required|string|max:255',
        ]);

        $mountainroute = $validatedData['mountainroute'];
        // $mountainroute['modified_by'] = Auth::id();

        $MountainRoutes->update($mountainroute);

        return redirect()->route('mountainroutes.index')->with('success', 'Record updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(MountainRoute $driverType)
    {
        //
    }
}
