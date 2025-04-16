<?php

namespace App\Http\Controllers;

use App\Models\Agent;
use Illuminate\Http\Request;

class AgentController extends Controller
{
    public function index() {
        $agents = Agent::latest()->paginate(10);
        $title = 'Agents';
        return view('agents.index', compact('agents', 'title'));
    }

    public function create() {
        $title = 'Create Agent';
        return view('agents.create', compact('title'));
    }

    public function store(Request $request) {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:agents',
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string',
        ]);

        Agent::create($request->all());

        return redirect()->route('agents.index')->with('success', 'Agent created successfully.');
    }

    public function show(Agent $agent) {
        $title = 'Agent Details';
        return view('agents.show', compact('agent', 'title'));
    }

    public function edit(Agent $agent) {
        $title = 'Edit Agent';
        return view('agents.edit', compact('agent', 'title'));
    }

    public function update(Request $request, Agent $agent) {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:agents,email,' . $agent->id,
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string',
        ]);

        $agent->update($request->all());

        return redirect()->route('agents.index')->with('success', 'Agent updated successfully.');
    }

    public function destroy(Agent $agent) {
        $agent->delete();
        return redirect()->route('agents.index')->with('success', 'Agent deleted successfully.');
    }
}
