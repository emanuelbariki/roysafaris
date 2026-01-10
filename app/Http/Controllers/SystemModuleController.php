<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSystemModuleRequest;
use App\Http\Requests\UpdateSystemModuleRequest;
use App\Models\SystemModule;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class SystemModuleController extends Controller
{
    /**
     * Display a listing of system modules.
     */
    public function index(): View
    {
        $this->authorize('view::module');
        $modules = SystemModule::with('permissions')
            ->withCount('permissions')
            ->orderBy('slug')
            ->get();

        return $this->extendedView('system-modules.index', compact('modules'), 'system modules');
    }

    /**
     * Store a newly created system module in storage.
     */
    public function store(StoreSystemModuleRequest $request): RedirectResponse
    {
        $this->authorize('create::module');
        SystemModule::create($request->validated());

        return redirect()
            ->route('system-modules.index')
            ->with('success', 'System module created successfully.');
    }

    /**
     * Update the specified system module in storage.
     */
    public function update(UpdateSystemModuleRequest $request, SystemModule $systemModule): RedirectResponse
    {
        $this->authorize('edit::module');
        $systemModule->update($request->validated());

        return redirect()
            ->route('system-modules.index')
            ->with('success', 'System module updated successfully.')
            ->with('system_module_id', $systemModule->id);
    }

    /**
     * Remove the specified system module from storage.
     */
    public function destroy(SystemModule $systemModule): RedirectResponse
    {
        $this->authorize('delete::module');
        // Check if the module has permissions
        if ($systemModule->permissions()->count() > 0) {
            return redirect()
                ->route('system-modules.index')
                ->with('error', 'Cannot delete system module as it has permissions assigned to it.');
        }

        $systemModule->delete();

        return redirect()
            ->route('system-modules.index')
            ->with('success', 'System module deleted successfully.');
    }
}
