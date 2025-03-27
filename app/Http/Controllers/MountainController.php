<?php

namespace App\Http\Controllers;

use App\Models\Country;
use App\Models\Mountain;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class MountainController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {        
        $tData['mountain'] = null;
        if ($request->has('edit')) {
            $tData['mountain']     = Mountain::find($request->edit);
        }

        $tData['countries']     = Country::all();
        $tData['mountains']     = Mountain::all();
        $tData['title']         = "Mountains";
        return view('masters.mountains', $tData);
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

        $mountain = $request->mountain;
        $exists = exists(Mountain::class, $mountain);
        if (!$exists) {
            try {
                $mountain = $request->mountain;
                $Mountain = Mountain::create($mountain);

                $Mountain->update([
                    'code' => str_pad($Mountain->id, 4, "0", STR_PAD_LEFT)
                ]);

                return redirect()->route('mountains.index')->with('success', 'Record added successfully!');
            } catch (\Throwable $th) {
                Log::error(message: $th->getMessage());
                return redirect()->route('mountains.index')->with('error', 'An error occurred while adding the car brand.');
            }
        }

        return redirect()->route('mountains.index')->with('error', 'Record already exists!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Mountain $mountain)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Mountain $mountain)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $Mountains = Mountain::findOrFail($id);
        $validatedData = $request->validate([
            'mountain.name' => 'required|string|max:255',
        ]);
        $mountain = $validatedData['mountain'];
        $Mountains->update($mountain);
        return redirect()->route('mountains.index')->with('success', 'Record updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Mountain $mountain)
    {
        //
    }

}
