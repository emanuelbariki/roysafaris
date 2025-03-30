<?php

namespace App\Http\Controllers;

use App\Models\Currency;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class CurrencyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {        
        $tData['currency'] = null;
        if ($request->has('edit')) {
            $tData['currency']     = Currency::find($request->edit);
        }

        $tData['currencies']        = Currency::all();
        $tData['title']          = "Currencies";
        return view('masters.currencies', $tData);
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

        $currency = $request->currency;
        $exists = exists(Currency::class, $currency);
        if (!$exists) {
            try {
                $currency = $request->currency;
                // dd($currency);
                Currency::create($currency);
                return redirect()->route('currencies.index')->with('success', 'Record added successfully!');
            } catch (\Throwable $th) {
                Log::error(message: $th->getMessage());
                return redirect()->route('currencies.index')->with('error', 'An error occurred while adding the car brand.');
            }
        }

        return redirect()->route('currencies.index')->with('error', 'Record already exists!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Currency $currency)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Currency $currency)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $Currencies = Currency::findOrFail($id);
        $validatedData = $request->validate([
            'currency.name' => 'required|string|max:255',
        ]);
        $currency = $validatedData['currency'];
        $Currencies->update($currency);
        return redirect()->route('currencies.index')->with('success', 'Record updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Currency $currency)
    {
        //
    }

}
