<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAgentRequest;
use App\Models\Agent;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class AgentController extends Controller
{
    public function index(): View
    {
        $data['agents'] = Agent::query()->latest()->paginate(10);

        return $this->extendedView('agents.index', $data, 'agents');
    }

    public function store(StoreAgentRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        Agent::create($validated);

        return redirect()
            ->route('agents.index')
            ->with('success', 'Agent created successfully.');
    }

    public function create(): View
    {
        return view('agents.create');
    }

    public function show(Agent $agent): View
    {
        return view('agents.show', compact('agent'));
    }

    public function edit(Agent $agent): View
    {
        return view('agents.edit', compact('agent'));
    }

    public function update(StoreAgentRequest $request, Agent $agent): RedirectResponse
    {
        $validated = $request->validated();

        $agent->update($validated);

        return redirect()
            ->route('agents.index')
            ->with('success', 'Agent updated successfully.');
    }

    public function destroy(Agent $agent): RedirectResponse
    {
        $agent->delete();

        return redirect()
            ->route('agents.index')
            ->with('success', 'Agent deleted successfully.');
    }
}
