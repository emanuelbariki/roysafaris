<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreDriverTypeRequest;
use App\Models\DriverType;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class DriverTypeController extends Controller
{
    public function index(): View
    {
        $data['driverTypes'] = DriverType::query()->latest()->paginate(10);

        return $this->extendedView('driver.types.index', $data, 'drivers types');
    }

    public function store(StoreDriverTypeRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        DriverType::create($validated);

        return redirect()
            ->route('drivertypes.index')
            ->with('flash_success', 'Driver type created successfully.');
    }

    public function create(): View
    {
        return view('driver.types.create');
    }

    public function show(DriverType $driverType): View
    {
        return view('driver.types.show', compact('driverType'));
    }

    public function edit(DriverType $driverType): View
    {
        return view('driver.types.edit', compact('driverType'));
    }

    public function update(StoreDriverTypeRequest $request, $id): RedirectResponse
    {
        $validated = $request->validated();
        $driverType = DriverType::findOrFail($id);

        $driverType->update($validated);

        return redirect()
            ->route('drivertypes.index')
            ->with('flash_success', 'Driver type updated successfully.');
    }

    public function destroy($type): RedirectResponse
    {
        $driverType = DriverType::findOrFail($type);
        $driverType->delete();

        return redirect()
            ->route('drivertypes.index')
            ->with('flash_success', 'Driver type deleted successfully.');
    }
}
