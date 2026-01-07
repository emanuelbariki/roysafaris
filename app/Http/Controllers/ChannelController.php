<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreChannelRequest;
use App\Models\Channel;

class ChannelController extends Controller
{
    public function index()
    {
        $data['channels'] = Channel::all();

        return $this->extendedView('channels.index', $data, 'channels');
    }

    public function store(StoreChannelRequest $request)
    {
        $validated = $request->validated();

        Channel::create($validated);

        return back()->with('flash_success', 'Channel created successfully.');
    }

    public function create()
    {
        return back()->with('flash_error', 'Not found');
    }

    public function edit(Channel $channel)
    {
        return back()->with('flash_error', 'Not found');
    }

    public function update(StoreChannelRequest $request, Channel $channel)
    {
        $validated = $request->validated();
        $channel->update($validated);

        return back()->with('flash_success', 'Channel updated successfully.');
    }

    public function destroy(Channel $channel)
    {
        $channel->delete();

        return back()->with('flash_success', 'Channel deleted successfully.');
    }
}
