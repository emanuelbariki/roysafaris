<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAgentRequest;
use App\Models\Agent;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class AgentController extends Controller
{
    /**
     * Display a listing of agents.
     */
    public function index(): View
    {
        $this->authorize('view::agent');
        $data['agents'] = Agent::query()->latest()->get();

        return $this->extendedView('agents.index', $data, 'agents');
    }

    /**
     * Store a newly created agent in storage.
     */
    public function store(StoreAgentRequest $request): RedirectResponse
    {
        $this->authorize('create::agent');
        $validated = $request->validated();

        Agent::query()->create($validated);

        return redirect()
            ->route('agents.index')
            ->with('success', 'Agent created successfully.');
    }

    public function create(): RedirectResponse
    {
        return back()->with('flush_error', 'Not Found');
    }

    public function show(Agent $agent): RedirectResponse
    {
        return back()->with('flush_error', 'Not Found');
    }

    public function edit(Agent $agent): RedirectResponse
    {
        return back()->with('flush_error', 'Not Found');
    }

    /**
     * Update the specified agent in storage.
     */
    public function update(StoreAgentRequest $request, Agent $agent): RedirectResponse
    {
        $this->authorize('edit::agent');
        $validated = $request->validated();

        $agent->update($validated);

        return redirect()
            ->route('agents.index')
            ->with('flush_success', 'Agent updated successfully.');
    }

    /**
     * Remove the specified agent from storage.
     */
    public function destroy(Agent $agent): RedirectResponse
    {
        $this->authorize('delete::agent');
        $agent->delete();

        return redirect()
            ->route('agents.index')
            ->with('flush_success', 'Agent deleted successfully.');
    }
}
