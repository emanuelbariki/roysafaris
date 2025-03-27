<?php

namespace App\Http\Controllers;

use App\Models\Channel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ChannelController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {        
        $tData['channel'] = null;
        if ($request->has('edit')) {
            $tData['channel'] = Channel::find($request->edit);
        }

        $tData['channels']  = Channel::all();
        $tData['title']     = "Channels";
        return view('masters.channels', $tData);
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

        $channel = $request->channel;
        $exists = exists(Channel::class, $channel);
        if (!$exists) {
            try {
                $channel = $request->channel;
                $Channel = Channel::create($channel);

                $Channel->update([
                    'code' => str_pad($Channel->id, 4, "0", STR_PAD_LEFT)
                ]);

                return redirect()->route('channels.index')->with('success', 'Record added successfully!');
            } catch (\Throwable $th) {
                Log::error(message: $th->getMessage());
                return redirect()->route('channels.index')->with('error', 'An error occurred while adding the car brand.');
            }
        }

        return redirect()->route('channels.index')->with('error', 'Record already exists!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Channel $channel)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Channel $channel)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $Channels = Channel::findOrFail($id);
        $validatedData = $request->validate([
            'channel.name' => 'required|string|max:255',
        ]);
        $channel = $validatedData['channel'];
        $Channels->update($channel);
        return redirect()->route('channels.index')->with('success', 'Record updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Channel $channel)
    {
        //
    }
}
