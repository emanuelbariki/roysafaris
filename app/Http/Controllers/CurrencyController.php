<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCurrencyRequest;
use App\Models\Currency;

class CurrencyController extends Controller
{
    public function index()
    {
        $data['currencies'] = Currency::all();

        return $this->extendedView('currencies.index', $data, 'currencies');
    }

    public function store(StoreCurrencyRequest $request)
    {
        $validated = $request->validated();

        Currency::create($validated);

        return back()->with('flash_success', 'Currency created successfully.');
    }

    public function create()
    {
        return back()->with('flash_error', 'Not found');
    }

    public function edit(Currency $currency)
    {
        return back()->with('flash_error', 'Not found');
    }

    public function update(StoreCurrencyRequest $request, Currency $currency)
    {
        $validated = $request->validated();
        $currency->update($validated);

        return back()->with('flash_success', 'Currency updated successfully.');
    }

    public function destroy(Currency $currency)
    {
        $currency->delete();

        return back()->with('flash_success', 'Currency deleted successfully.');
    }
}
