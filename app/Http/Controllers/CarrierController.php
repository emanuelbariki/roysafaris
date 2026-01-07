<?php

namespace App\Http\Controllers;

use App\Enums\BankName;
use App\Http\Requests\StoreCarrierRequest;
use App\Models\BankAccount;
use App\Models\Carrier;
use App\Models\Country;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Throwable;

class CarrierController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $data['banks'] = BankName::cases();
        $data['title'] = 'Carriers';
        $data['countries'] = Country::all();
        $data['carriers'] = Carrier::all();

        return $this->extendedView('carriers.index', $data, 'carriers');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCarrierRequest $request)
    {
        try {
            $validated = $request->validated();
            $validated['voucher_copies'] = 3;

            $carrier = Carrier::create($validated);

            // Generate code
            $carrier->update([
                'code' => str_pad($carrier->id, 4, '0', STR_PAD_LEFT),
            ]);

            // Create bank account if provided
            if (isset($validated['bank_name']) && $validated['bank_name'] != '') {
                $account = new BankAccount;
                $account->account_for = 'carrier';
                $account->ref_id = $carrier->id;
                $account->bank_name = $validated['bank_name'];
                $account->bank_no = $validated['bank_no'] ?? null;
                $account->save();
            }

            return redirect()
                ->route('carriers.index')
                ->with('success', 'Carrier created successfully!');
        } catch (Throwable $e) {
            Log::error('Error creating carrier: '.$e->getMessage(), [
                'exception' => $e,
            ]);

            return redirect()
                ->route('carriers.index')
                ->with('error', 'An error occurred while creating the carrier.')
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
    public function update(StoreCarrierRequest $request, $id)
    {
        try {
            $validated = $request->validated();
            $carrier = Carrier::findOrFail($id);

            $carrier->update($validated);

            return redirect()
                ->route('carriers.index')
                ->with('success', 'Carrier updated successfully!');
        } catch (Throwable $e) {
            Log::error('Error updating carrier: '.$e->getMessage(), [
                'exception' => $e,
            ]);

            return redirect()
                ->route('carriers.index')
                ->with('error', 'An error occurred while updating the carrier.')
                ->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Carrier $carrier)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Carrier $carrier)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $carrier = Carrier::findOrFail($id);
            $carrier->delete();

            return redirect()
                ->route('carriers.index')
                ->with('success', 'Carrier deleted successfully!');
        } catch (Throwable $e) {
            Log::error('Error deleting carrier: '.$e->getMessage(), [
                'exception' => $e,
            ]);

            return redirect()
                ->route('carriers.index')
                ->with('error', 'An error occurred while deleting the carrier.');
        }
    }
}
