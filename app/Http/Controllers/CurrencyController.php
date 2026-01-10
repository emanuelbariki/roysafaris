<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCurrencyRequest;
use App\Models\Currency;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class CurrencyController extends Controller
{
    /**
     * Display a listing of currencies.
     */
    public function index(): View
    {
        $this->authorize('view::currency');
        $data['currencies'] = Currency::all();

        return $this->extendedView('currencies.index', $data, 'currencies');
    }

    /**
     * Store a newly created currency in storage.
     */
    public function store(StoreCurrencyRequest $request): RedirectResponse
    {
        $this->authorize('create::currency');
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

    /**
     * Update the specified currency in storage.
     */
    public function update(StoreCurrencyRequest $request, Currency $currency): RedirectResponse
    {
        $this->authorize('edit::currency');
        $validated = $request->validated();
        $currency->update($validated);

        return back()->with('flash_success', 'Currency updated successfully.');
    }

    /**
     * Remove the specified currency from storage.
     */
    public function destroy(Currency $currency): RedirectResponse
    {
        $this->authorize('delete::currency');
        $currency->delete();

        return back()->with('flash_success', 'Currency deleted successfully.');
    }
}
