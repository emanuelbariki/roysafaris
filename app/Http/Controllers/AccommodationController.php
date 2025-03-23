<?php

namespace App\Http\Controllers;

use App\Models\Accommodation;
use App\Models\AccommodationType;
use App\Models\BankAccount;
use App\Models\HotelChain;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class AccommodationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
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
        
        $tData['accommodation'] = null;
        if ($request->has('edit')) {
            $tData['accommodation'] = Accommodation::find($request->edit);
        }

        $tData['accommodationTypes'] = AccommodationType::all();
        $tData['hotelChains'] = HotelChain::all();
        $tData['accommodations'] = Accommodation::all();
        $tData['title'] = "Accommodations";

        return view('masters.accommodations', $tData);
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
        // Check if accommodation already exists
        $validatedData = $request->accommodation;
        $accommodationData = $validatedData;
        $exists = exists(Accommodation::class, ['code' => $accommodationData['code']]);
        if (!$exists) {
            try {
                $Accommodation = Accommodation::create($accommodationData);
                if (isset($request->bank_name) && $request->bank_name != "") {
                    $account = new BankAccount();
                    $account->account_for = "accommodation";
                    $account->ref_id = $Accommodation->id;
                    $account->bank_name = $request->bank_name;
                    $account->bank_no = $request->bank_no;
                    $account->save();
                }
                return redirect()->route('accommodations.index')->with('success', 'Accommodation added successfully!');
            } catch (\Throwable $th) {
                Log::error($th->getMessage());
                return redirect()->route('accommodations.index')->with('error', 'An error occurred while adding the accommodation.');
            }
        }

        return redirect()->route('accommodations.index')->with('error', 'Accommodation already exists!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Accommodation $accommodation)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Accommodation $accommodation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $accommodation = Accommodation::findOrFail($id);

        $validatedData = $request->validate([
            'accommodation.name' => 'required|string|max:255',
            'accommodation.code' => 'required|string|max:50|unique:accommodations,code,' . $id,
            'accommodation.hotel_chain_id' => 'required|exists:hotel_chains,id',
            'accommodation.accommodations_type_id' => 'required|exists:accommodation_types,id',
            'accommodation.address' => 'nullable|string|max:255',
            'accommodation.city' => 'nullable|string|max:100',
            'accommodation.country' => 'nullable|string|max:100',
            'accommodation.phone' => 'nullable|string|max:20',
            'accommodation.email' => 'nullable|email|max:255',
            'accommodation.website' => 'nullable|url|max:255',
            'accommodation.camping_logistics' => 'nullable|in:yes,no',
            'accommodation.balloon_pickup' => 'nullable|in:yes,no',
            'accommodation.voucher_copies' => 'nullable|integer|min:0',
            'accommodation.pay_to' => 'nullable|in:hotel,chain',
            'accommodation.billing_ccy' => 'nullable|string|max:10',
            'accommodation.coordinates' => 'nullable|string|max:50',
        ]);

        $accommodation->update($validatedData['accommodation']);
        return redirect()->route('accommodations.index')->with('success', 'Accommodation updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Accommodation $accommodation)
    {
        //
    }
}
