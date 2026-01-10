<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreLodgeRequest;
use App\Models\Lodge;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class LodgeController extends Controller
{
    /**
     * Display a listing of lodges.
     */
    public function index(): View
    {
        $this->authorize('view::lodge');
        $data['lodges'] = Lodge::query()->latest()->paginate(10);

        return $this->extendedView('lodges.index', $data, 'lodges');
    }

    /**
     * Store a newly created lodge in storage.
     */
    public function store(StoreLodgeRequest $request): RedirectResponse
    {
        $this->authorize('create::lodge');
        $validated = $request->validated();

        Lodge::create($validated);

        return redirect()
            ->route('lodges.index')
            ->with('success', 'Lodge created successfully.');
    }

    public function create(): View
    {
        return view('lodges.create');
    }

    public function show(Lodge $lodge): View
    {
        return view('lodges.show', compact('lodge'));
    }

    public function edit(Lodge $lodge): View
    {
        return view('lodges.edit', compact('lodge'));
    }

    /**
     * Update the specified lodge in storage.
     */
    public function update(StoreLodgeRequest $request, Lodge $lodge): RedirectResponse
    {
        $this->authorize('edit::lodge');
        $validated = $request->validated();

        $lodge->update($validated);

        return redirect()
            ->route('lodges.index')
            ->with('success', 'Lodge updated successfully.');
    }

    /**
     * Remove the specified lodge from storage.
     */
    public function destroy(Lodge $lodge): RedirectResponse
    {
        $this->authorize('delete::lodge');
        $lodge->delete();

        return redirect()
            ->route('lodges.index')
            ->with('success', 'Lodge deleted successfully.');
    }
}
