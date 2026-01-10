<?php

namespace App\Http\Controllers;

use App\Enums\BankName;
use App\Http\Requests\StoreServiceProviderRequest;
use App\Models\BankAccount;
use App\Models\Country;
use App\Models\ServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;
use Throwable;

class ServiceProviderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $this->authorize('view::service_provider');
        $data['banks'] = BankName::cases();
        $data['countries'] = Country::all();
        $data['serviceproviders'] = ServiceProvider::all();

        return $this->extendedView('service.providers.index', $data, 'service providers');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreServiceProviderRequest $request): RedirectResponse
    {
        $this->authorize('create::service_provider');
        try {
            $validated = $request->validated();
            $validated['voucher_copies'] = 3;

            $provider = ServiceProvider::create($validated);

            // Generate code
            $provider->update([
                'code' => str_pad($provider->id, 4, '0', STR_PAD_LEFT),
            ]);

            // Create bank account if provided
            if (isset($validated['bank_name']) && $validated['bank_name'] != '') {
                $account = new BankAccount;
                $account->account_for = 'service_provider';
                $account->ref_id = $provider->id;
                $account->bank_name = $validated['bank_name'];
                $account->bank_no = $validated['bank_no'] ?? null;
                $account->save();
            }

            return redirect()
                ->route('serviceproviders.index')
                ->with('success', 'Service provider created successfully!');
        } catch (Throwable $e) {
            Log::error('Error creating service provider: '.$e->getMessage(), [
                'exception' => $e,
            ]);

            return redirect()
                ->route('serviceproviders.index')
                ->with('error', 'An error occurred while creating the service provider.')
                ->withInput();
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
     * Update the specified resource in storage.
     */
    public function update(StoreServiceProviderRequest $request, $id): RedirectResponse
    {
        $this->authorize('edit::service_provider');
        try {
            $validated = $request->validated();
            $provider = ServiceProvider::findOrFail($id);

            $provider->update($validated);

            return redirect()
                ->route('serviceproviders.index')
                ->with('success', 'Service provider updated successfully!');
        } catch (Throwable $e) {
            Log::error('Error updating service provider: '.$e->getMessage(), [
                'exception' => $e,
            ]);

            return redirect()
                ->route('serviceproviders.index')
                ->with('error', 'An error occurred while updating the service provider.')
                ->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(ServiceProvider $serviceProvider)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ServiceProvider $serviceProvider)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id): RedirectResponse
    {
        $this->authorize('delete::service_provider');
        try {
            $provider = ServiceProvider::findOrFail($id);
            $provider->delete();

            return redirect()
                ->route('serviceproviders.index')
                ->with('success', 'Service provider deleted successfully!');
        } catch (Throwable $e) {
            Log::error('Error deleting service provider: '.$e->getMessage(), [
                'exception' => $e,
            ]);

            return redirect()
                ->route('serviceproviders.index')
                ->with('error', 'An error occurred while deleting the service provider.');
        }
    }
}
