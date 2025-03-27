<?php

namespace App\Http\Controllers;

use App\Models\BankAccount;
use App\Models\Country;
use App\Models\ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ServiceProviderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //
        
        $tData['serviceprovider'] = null;
        if ($request->has('edit')) {
            $tData['serviceprovider'] = ServiceProvider::find($request->edit);
        }
        $tData['banks'] = [
            ['full_name' => 'Absa Bank Tanzania Limited', 'short_name' => 'Absa'],
            ['full_name' => 'Access Bank Tanzania Limited', 'short_name' => 'Access Bank'],
            ['full_name' => 'Akiba Commercial Bank Plc', 'short_name' => 'ACB'],
            ['full_name' => 'Amana Bank Limited', 'short_name' => 'Amana Bank'],
            ['full_name' => 'Azania Bank Limited', 'short_name' => 'Azania Bank'],
            ['full_name' => 'Bank of Africa Tanzania Limited', 'short_name' => 'BOA'],
            ['full_name' => 'Bank of Baroda Tanzania Limited', 'short_name' => 'Bank of Baroda'],
            ['full_name' => 'Bank of India Tanzania Limited', 'short_name' => 'Bank of India'],
            ['full_name' => 'China Dasheng Bank Limited', 'short_name' => 'China Dasheng Bank'],
            ['full_name' => 'Citibank Tanzania Limited', 'short_name' => 'Citibank'],
            ['full_name' => 'CRDB Bank Plc', 'short_name' => 'CRDB'],
            ['full_name' => 'DCB Commercial Bank Plc', 'short_name' => 'DCB'],
            ['full_name' => 'Diamond Trust Bank Tanzania Limited', 'short_name' => 'DTB'],
            ['full_name' => 'Ecobank Tanzania Limited', 'short_name' => 'Ecobank'],
            ['full_name' => 'Equity Bank Tanzania Limited', 'short_name' => 'Equity Bank'],
            ['full_name' => 'Exim Bank Tanzania Limited', 'short_name' => 'Exim Bank'],
            ['full_name' => 'Guaranty Trust Bank Tanzania Limited', 'short_name' => 'GTBank'],
            ['full_name' => 'Habib African Bank Limited', 'short_name' => 'Habib African Bank'],
            ['full_name' => 'I&M Bank Tanzania Limited', 'short_name' => 'I&M Bank'],
            ['full_name' => 'International Commercial Bank Tanzania Limited', 'short_name' => 'ICB'],
            ['full_name' => 'KCB Bank Tanzania Limited', 'short_name' => 'KCB'],
            ['full_name' => 'Letshego Faidika Bank Tanzania Limited', 'short_name' => 'Letshego Bank'],
            ['full_name' => 'Mkombozi Commercial Bank Plc', 'short_name' => 'Mkombozi Bank'],
            ['full_name' => 'Mwalimu Commercial Bank Plc', 'short_name' => 'MCB'],
            ['full_name' => 'Mwanga Hakika Bank Limited', 'short_name' => 'Mwanga Hakika Bank'],
            ['full_name' => 'National Bank of Commerce Limited', 'short_name' => 'NBC'],
            ['full_name' => 'NCBA Bank Tanzania Limited', 'short_name' => 'NCBA'],
            ['full_name' => 'NMB Bank Plc', 'short_name' => 'NMB'],
            ['full_name' => 'People\'s Bank of Zanzibar Limited', 'short_name' => 'PBZ'],
            ['full_name' => 'Stanbic Bank Tanzania Limited', 'short_name' => 'Stanbic'],
            ['full_name' => 'Standard Chartered Bank Tanzania Limited', 'short_name' => 'Standard Chartered'],
            ['full_name' => 'Tanzania Commercial Bank Plc', 'short_name' => 'TCB'],
            ['full_name' => 'United Bank for Africa Tanzania Limited', 'short_name' => 'UBA']
        ];

        $tData['countries'] = Country::all();
        // $tData['countries'] = Country::all();
        $tData['serviceproviders'] = ServiceProvider::all();
        $tData['title'] = "Service Provier";
        return view('masters.service_providers', $tData);
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
        $exists = exists(ServiceProvider::class, $request->serviceprovider);
        if (!$exists) {
            try {
                $serviceprovider = $request->serviceprovider;
                $ServiceProvider = ServiceProvider::create($serviceprovider);

                $ServiceProvider->update([
                    'code' => str_pad($ServiceProvider->id, 4, "0", STR_PAD_LEFT)
                ]);

                if (isset($request->bank_name) && $request->bank_name != "") {
                    $account = new BankAccount();
                    $account->account_for = "service_provider";
                    $account->ref_id = $ServiceProvider->id;
                    $account->bank_name = $request->bank_name;
                    $account->bank_no = $request->bank_no;
                    $account->save();
                }


                return redirect()->route('serviceproviders.index')->with('success', 'Record added successfully!');
            } catch (\Throwable $th) {
                Log::error(message: $th->getMessage());
                return redirect()->route('serviceproviders.index')->with('error', 'An error occurred while adding the car brand.');
            }
        }

        return redirect()->route('serviceproviders.index')->with('error', 'Record already exists!');
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
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        //
        //
        $ServiceProviders = ServiceProvider::findOrFail($id);
        
        $validatedData = $request->validate([
            'serviceprovider.name' => 'required|string|max:255',
        ]);

        $serviceprovider = $validatedData['serviceprovider'];
        // $serviceprovider['modified_by'] = Auth::id();

        $ServiceProviders->update($serviceprovider);

        return redirect()->route('serviceproviders.index')->with('success', 'Record updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ServiceProvider $serviceProvider)
    {
        //
    }
}
