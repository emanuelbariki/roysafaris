<?php

namespace App\Http\Controllers;

use App\Models\BankAccount;
use App\Models\Carrier;
use App\Models\Country;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class CarrierController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //

        if ($request->has('edit')) {
            $tData['carrier'] = Carrier::find($request->edit);
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
        $tData['title'] = "Carriers";
        $tData['countries'] = Country::all();
        $tData['carriers'] = Carrier::all();

        return view('masters.carriers', $tData);
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

        $carrier = $request->carrier;
        $exists = exists(Carrier::class, array('name'=>$carrier['name']));
        if (!$exists) {
            try {
                $carrier = $request->carrier;
                $carrier['voucher_copies'] = 3;
                $Carrier = Carrier::create($carrier);

                $Carrier->update([
                    'code' => str_pad($Carrier->id, 4, "0", STR_PAD_LEFT)
                ]);

                if (isset($request->bank_name) && $request->bank_name != "") {
                    $account = new BankAccount();
                    $account->account_for = "carrier";
                    $account->ref_id = $Carrier->id;
                    $account->bank_name = $request->bank_name;
                    $account->bank_no = $request->bank_no;
                    $account->save();
                }
                
                return redirect()->route('carriers.index')->with('success', 'Record added successfully!');
            } catch (\Throwable $th) {
                Log::error(message: $th->getMessage());
                return redirect()->route('carriers.index')->with('error', 'An error occurred while adding the car brand.');
            }
        }

        return redirect()->route('carriers.index')->with('error', 'Record already exists!');
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
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        //
        $Carriers = Carrier::findOrFail($id);
        $validatedData = $request->validate([
            'carrier.name' => 'required|string|max:255',
        ]);
        $carrier = $validatedData['carrier'];
        $Carriers->update($carrier);
        return redirect()->route('carriers.index')->with('success', 'Record updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Carrier $carrier)
    {
        //
    }
}
