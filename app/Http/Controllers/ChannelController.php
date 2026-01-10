<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreChannelRequest;
use App\Models\Channel;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class ChannelController extends Controller
{
    /**
     * Display a listing of channels.
     */
    public function index(): View
    {
        $this->authorize('view::channel');
        $data['channels'] = Channel::all();

        return $this->extendedView('channels.index', $data, 'channels');
    }

    /**
     * Store a newly created channel in storage.
     */
    public function store(StoreChannelRequest $request): RedirectResponse
    {
        $this->authorize('create::channel');
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

    /**
     * Update the specified channel in storage.
     */
    public function update(StoreChannelRequest $request, Channel $channel): RedirectResponse
    {
        $this->authorize('edit::channel');
        $validated = $request->validated();
        $channel->update($validated);

        return back()->with('flash_success', 'Channel updated successfully.');
    }

    /**
     * Remove the specified channel from storage.
     */
    public function destroy(Channel $channel): RedirectResponse
    {
        $this->authorize('delete::channel');
        $channel->delete();

        return back()->with('flash_success', 'Channel deleted successfully.');
    }
}
