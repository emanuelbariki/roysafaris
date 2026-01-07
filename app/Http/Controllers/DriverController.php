<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreDriverRequest;
use App\Http\Requests\StoreDriverTypeRequest;
use App\Models\Driver;
use App\Models\DriverType;
use App\Models\Fleet;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;
use Throwable;

class DriverController extends Controller
{
    public function drivers(): View
    {
        return $this->index();
    }

    public function index(): View
    {
        try {
            $data['drivers'] = Driver::query()
                ->with('fleet', 'driverType')
                ->latest()
                ->paginate(10);
            $data['driverTypes'] = DriverType::query()
                ->select('id', 'name')
                ->where('status', 'active')
                ->get();
            $data['fleets'] = Fleet::query()
                ->select('id', 'make_model')
                ->where('status', 'active')
                ->get();

            return $this->extendedView('driver.index', $data, 'drivers');
        } catch (Throwable $e) {
            Log::error('Error loading drivers: '.$e->getMessage(), [
                'exception' => $e,
            ]);

            return back()
                ->with('flash_error', 'Unable to load drivers at this time. Please try again.');
        }
    }

    public function store(StoreDriverRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        Driver::create($validated);

        return redirect()
            ->route('drivers.index')
            ->with('flash_success', 'Driver created successfully.');
    }

    public function driverStore(StoreDriverRequest $request): RedirectResponse
    {
        return $this->store($request);
    }

    public function create(): View
    {
        return view('driver.create');
    }

    public function show(Driver $driver): View
    {
        return view('driver.show', compact('driver'));
    }

    public function edit(Driver $driver): View
    {
        return view('driver.edit', compact('driver'));
    }

    public function update(StoreDriverRequest $request, $driver): RedirectResponse
    {
        $validated = $request->validated();
        $driverModel = Driver::findOrFail($driver);

        $driverModel->update($validated);

        return redirect()
            ->route('drivers.index')
            ->with('flash_success', 'Driver updated successfully.');
    }

    public function driverUpdate(StoreDriverRequest $request, $driver): RedirectResponse
    {
        return $this->update($request, $driver);
    }

    public function destroy($driver): RedirectResponse
    {
        $driverModel = Driver::findOrFail($driver);
        $driverModel->delete();

        return redirect()
            ->route('drivers.index')
            ->with('flash_success', 'Driver deleted successfully.');
    }

    public function driverDestroy($driver): RedirectResponse
    {
        return $this->destroy($driver);
    }

    public function Ajax_getDriverFleet($driverId)
    {
        $driver = Driver::findOrFail($driverId);
        $fleets = Fleet::where('id', $driver->fleet_id)->get();

        return response()->json($fleets);
    }

    public function driverTypes(): View
    {
        try {
            $data['driverTypes'] = DriverType::query()
                ->select('id', 'name', 'status')
                ->get();

            return $this->extendedView('driver.types.index', $data, 'drivers types');
        } catch (Throwable $e) {
            Log::error('Error loading driver types: '.$e->getMessage(), [
                'exception' => $e,
            ]);

            return back()
                ->with('flash_error', 'Unable to load driver types at this time. Please try again.');
        }
    }

    public function driverTypesStore(StoreDriverTypeRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        DriverType::create($validated);

        return redirect()
            ->route('drivertypes.index')
            ->with('flash_success', 'Driver type created successfully.');
    }

    public function driverTypesUpdate(StoreDriverTypeRequest $request, $type): RedirectResponse
    {
        $validated = $request->validated();
        $driverType = DriverType::findOrFail($type);

        $driverType->update($validated);

        return redirect()
            ->route('drivertypes.index')
            ->with('flash_success', 'Driver type updated successfully.');
    }

    public function driverTypesDestroy($type): RedirectResponse
    {
        $driverType = DriverType::findOrFail($type);
        $driverType->delete();

        return redirect()
            ->route('drivertypes.index')
            ->with('flash_success', 'Driver type deleted successfully.');
    }
}
