<?php

namespace App\Http\Controllers;

use App\Models\VehicleType;
use App\Http\Requests\StoreVehicleTypeRequest;
use Illuminate\Http\Request;

class VehicleTypeController extends Controller
{
    public function index()
    {
        $vehicles = VehicleType::all();
        $vehicleType = new VehicleType();
        $title = 'Vehicle Types';

        return view('vehicle_types.index', compact('vehicles','vehicleType','title'));
    }

    public function create()
    {
        return view('vehicle_types.create', [
            'title' => 'Create Vehicle Type',
        ]);
    }

    public function store(StoreVehicleTypeRequest $request)
    {
        $data = $request->validated();

        VehicleType::create($data);

        return redirect()->route('vehicle-types.index')->with('success', 'Vehicle type created successfully.');
    }

    public function edit(VehicleType $vehicleType)
    {
        $title = 'Edit Vehicle Type';
        return view('vehicle_types.edit', compact('vehicleType','title'));
    }

    public function update(StoreVehicleTypeRequest $request, VehicleType $vehicleType)
    {
        $data = $request->validated();

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('vehicle_images', 'public');
        }

        if ($request->hasFile('insurance_doc')) {
            $data['insurance_doc'] = $request->file('insurance_doc')->store('vehicle_docs', 'public');
        }

        if ($request->hasFile('registration_doc')) {
            $data['registration_doc'] = $request->file('registration_doc')->store('vehicle_docs', 'public');
        }

        $vehicleType->update($data);

        return redirect()->route('vehicle-types.index')->with('success', 'Vehicle type updated successfully.');
    }

    public function destroy(VehicleType $vehicleType)
    {
        $vehicleType->delete();
        return redirect()->route('vehicle-types.index')->with('success', 'Vehicle type deleted successfully.');
    }
}