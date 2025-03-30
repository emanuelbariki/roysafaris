<?php

namespace App\Http\Controllers;

use App\Models\AgeGroup;
use App\Models\Currency;
use App\Models\FeeType;
use App\Models\NationalPark;
use App\Models\ParkFee;
use App\Models\Season;
use App\Models\VisitorCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ParkFeeController extends Controller
{
   /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {        
        $tData['parkFee'] = null;
        if ($request->has('edit')) {
            $tData['parkFee'] = ParkFee::find($request->edit);
        }

        $tData['parkFees'] = ParkFee::with(['nationalPark', 'feeType', 'visitorCategory', 'ageGroup', 'season', 'currency'])->get();
        // dd($tData);
        $tData['title']         = "Park Fees";
        $tData['nationalParks'] = NationalPark::all();
        $tData['feeTypes']      = FeeType::all();
        $tData['visitorCategories'] = VisitorCategory::all();
        $tData['ageGroups']         = AgeGroup::all();
        $tData['seasons']           = Season::all();
        $tData['currencies']        = Currency::all();

        return view('masters.park_fees', $tData);
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
        $validatedData = $request->all();
        // dd($validatedData);
        $exists = ParkFee::where([
            'national_park_id'    => $validatedData['fee']['national_park_id'],
            'season_id'           => $validatedData['fee']['season_id'],
            'fee_type_id'         => $validatedData['feeType'],
            'visitor_category_id' => $validatedData['visitorCategory'],
            'age_group_id'        => $validatedData['ageGroup'],
            'currency_id'         => $validatedData['currency'],
        ])->exists();

        
        if (!$exists) {
            try {
                foreach ($validatedData['feeType'] as $key => $fee_type_id) {
                    
                    $parkFee = new ParkFee();
                    $parkFee->national_park_id      = $validatedData['fee']['national_park_id'];
                    $parkFee->season_id             = $validatedData['fee']['season_id'];
                    $parkFee->fee_type_id           = $validatedData['feeType'][$key];
                    $parkFee->visitor_category_id   = $validatedData['visitorCategory'][$key];
                    $parkFee->age_group_id          = $validatedData['ageGroup'][$key];
                    $parkFee->currency_id           = $validatedData['currency'][$key];
                    $parkFee->amount                = $validatedData['amount'][$key];
                    $parkFee->vat_rate              = $validatedData['vatRate'][$key];
                    $parkFee->is_vat_inclusive      = $validatedData['vatInclusive'][$key] ?? NULL;  //isset($validatedData['vatInclusive'][$key]) ? $validatedData['vatInclusive'][$key] : NULL;
                    $parkFee->effective_date        = $validatedData['fee']['effectiveDate'];
                    $parkFee->is_one_time_fee       = $validatedData['isOneTimeFee'][$key] ?? NULL;
                    
                    $parkFee->save();
                }
                return redirect()->route('parkfees.index')->with('success', 'Record added successfully!');
            } catch (\Throwable $th) {
                Log::error($th->getMessage());
                return redirect()->route('parkfees.index')->with('error', 'An error occurred while adding the park fee.');
            }
        }

        return redirect()->route('parkfees.index')->with('error', 'Record already exists!');
    }

    /**
     * Display the specified resource.
     */
    public function show(ParkFee $parkFee)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ParkFee $parkFee)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $parkFee = ParkFee::findOrFail($id);

        $validatedData = $request->validate([
            'amount'           => 'sometimes|numeric|min:0',
            'vat_rate'         => 'sometimes|numeric|min:0|max:100',
            'is_vat_inclusive' => 'boolean',
            'effective_date'   => 'nullable|date',
            'status'           => 'sometimes|in:active,inactive',
        ]);

        $parkFee->update($validatedData);

        return redirect()->route('park-fees.index')->with('success', 'Record updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ParkFee $parkFee)
    {
        try {
            $parkFee->delete();
            return redirect()->route('park-fees.index')->with('success', 'Record deleted successfully!');
        } catch (\Throwable $th) {
            Log::error($th->getMessage());
            return redirect()->route('park-fees.index')->with('error', 'An error occurred while deleting the record.');
        }
    }

    public function Ajax_parkFeesData(){
        $tData['feeTypes'] = FeeType::all();
        $tData['visitorCategories'] = VisitorCategory::all();
        $tData['ageGroups'] = AgeGroup::all();
        $tData['currencies'] = Currency::all();
        
        return json_encode($tData);
    }
}
