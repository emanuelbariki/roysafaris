<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreServiceItemRequest;
use App\Models\ServiceItem;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;
use Throwable;

class ServiceItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $this->authorize('view::service_item');
        $data['serviceItems'] = ServiceItem::all();

        $tData['title'] = 'Service Items';

        return $this->extendedView('service.items.index', $data, 'service items');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreServiceItemRequest $request): RedirectResponse
    {
        $this->authorize('create::service_item');
        try {
            $validated = $request->validated();

            ServiceItem::create($validated);

            return redirect()
                ->route('serviceitems.index')
                ->with('success', 'Service item created successfully!');
        } catch (Throwable $e) {
            Log::error('Error creating service item: '.$e->getMessage(), [
                'exception' => $e,
            ]);

            return redirect()
                ->route('serviceitems.index')
                ->with('error', 'An error occurred while creating the service item.');
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
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
    public function update(StoreServiceItemRequest $request, $id): RedirectResponse
    {
        $this->authorize('edit::service_item');
        try {
            $validated = $request->validated();
            $serviceItem = ServiceItem::findOrFail($id);

            $serviceItem->update($validated);

            return redirect()
                ->route('serviceitems.index')
                ->with('success', 'Service item updated successfully!');
        } catch (Throwable $e) {
            Log::error('Error updating service item: '.$e->getMessage(), [
                'exception' => $e,
            ]);

            return redirect()
                ->route('serviceitems.index')
                ->with('error', 'An error occurred while updating the service item.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id): RedirectResponse
    {
        $this->authorize('delete::service_item');
        try {
            $serviceItem = ServiceItem::findOrFail($id);
            $serviceItem->delete();

            return redirect()
                ->route('serviceitems.index')
                ->with('success', 'service item deleted successfully!');
        } catch (Throwable $e) {
            Log::error('Error deleting service item: '.$e->getMessage(), [
                'exception' => $e,
            ]);

            return redirect()
                ->route('serviceitems.index')
                ->with('error', 'An error occurred while deleting the service item.');
        }
    }
}
