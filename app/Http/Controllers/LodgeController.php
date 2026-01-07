<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreLodgeRequest;
use App\Models\Lodge;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class LodgeController extends Controller
{
    public function index(): View
    {
        $data['lodges'] = Lodge::query()->latest()->paginate(10);

        return $this->extendedView('lodges.index', $data, 'lodges');
    }

    public function store(StoreLodgeRequest $request): RedirectResponse
    {
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

    public function update(StoreLodgeRequest $request, Lodge $lodge): RedirectResponse
    {
        $validated = $request->validated();

        $lodge->update($validated);

        return redirect()
            ->route('lodges.index')
            ->with('success', 'Lodge updated successfully.');
    }

    public function destroy(Lodge $lodge): RedirectResponse
    {
        $lodge->delete();

        return redirect()
            ->route('lodges.index')
            ->with('success', 'Lodge deleted successfully.');
    }
}
