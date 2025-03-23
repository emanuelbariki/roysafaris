<?php

namespace App\Http\Controllers;

use App\Models\ServiceItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ServiceItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //
        $tData['serviceitem'] = null;
        if ($request->has('edit')) {
            $tData['serviceitem'] = ServiceItem::find($request->edit);
        }
        $tData['serviceitems'] = ServiceItem::all();

        $tData['title'] = "Service Items";
        return view('masters.service_items', $tData);
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
        $exists = exists(ServiceItem::class, $request->serviceitem);
        if (!$exists) {
            try {
                $serviceitem = $request->serviceitem;
                // $serviceitem['created_by'] = Auth::user()->id;

                ServiceItem::create($serviceitem);
                return redirect()->route('serviceitems.index')->with('success', 'Record added successfully!');
            } catch (\Throwable $th) {
                Log::error(message: $th->getMessage());

                return redirect()->route('serviceitems.index')->with('error', 'An error occurred while adding the car brand.');
            } 
        }

        return redirect()->route('serviceitems.index')->with('error', 'Record already exists!');
    }

    /**
     * Display the specified resource.
     */
    public function show(ServiceItem $serviceItem)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ServiceItem $serviceItem)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        //
        $ServiceItem = ServiceItem::findOrFail($id);
        
        $validatedData = $request->validate([
            'serviceitem.name' => 'required|string|max:255',
        ]);

        $serviceitem = $validatedData['serviceitem'];
        // $serviceitem['modified_by'] = Auth::id();

        $ServiceItem->update($serviceitem);

        return redirect()->route('serviceitems.index')->with('success', 'Record updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ServiceItem $serviceItem)
    {
        //
    }
}
