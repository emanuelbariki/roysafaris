<?php

namespace App\Http\Controllers;

use App\Models\Lodge;
use Illuminate\Http\Request;

class LodgeController extends Controller
{
    public function index() {
        $lodges = Lodge::latest()->paginate(10);
        $title = 'Lodges';
        
        return view('lodges.index', compact('lodges', 'title'));
    }

    public function create() {
        $title = 'Create Lodge';
        return view('lodges.create', compact('title'));
    }

    public function store(Request $request) {
        $request->validate([
            'name' => 'required|string|max:255',
            'location' => 'nullable|string|max:255',
            'phone' => 'nullable|string|max:20',
            'email' => 'nullable|email',
            'description' => 'nullable|string',
        ]);

        Lodge::create($request->all());

        return redirect()->route('lodges.index')->with('success', 'Lodge created successfully.');
    }

    public function show(Lodge $lodge) {
        $title = 'Lodge Details';
        return view('lodges.show', compact('lodge', 'title'));
    }

    public function edit(Lodge $lodge) {
        $title = 'Edit Lodge';
        return view('lodges.edit', compact('lodge', 'title'));
    }

    public function update(Request $request, Lodge $lodge) {
        $request->validate([
            'name' => 'required|string|max:255',
            'location' => 'nullable|string|max:255',
            'phone' => 'nullable|string|max:20',
            'email' => 'nullable|email',
            'description' => 'nullable|string',
        ]);

        $lodge->update($request->all());

        return redirect()->route('lodges.index')->with('success', 'Lodge updated successfully.');
    }

    public function destroy(Lodge $lodge) {
        $lodge->delete();
        return redirect()->route('lodges.index')->with('success', 'Lodge deleted successfully.');
    }
}
