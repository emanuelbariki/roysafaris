<?php

namespace App\Http\Controllers;

use App\Http\Requests\FleetClass\StoreFleetClassRequest;
use App\Http\Requests\FleetClass\UpdateFleetClassRequest;
use App\Http\Requests\FleetType\StoreFleetTypeRequest;
use App\Http\Requests\FleetType\UpdateFleetTypeRequest;
use App\Http\Requests\StoreFleetRequest;
use App\Http\Requests\UpdateFleetRequest;
use App\Models\Fleet;
use App\Models\FleetClass;
use App\Models\FleetType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Throwable;

class FleetController extends Controller
{
    public function fleets()
    {
        try {
            $data['fleets'] = Fleet::query()
                ->with('fleetType', 'fleetClass', 'drivers')->get();
            $data['fleetTypes'] = FleetType::query()->select('id', 'name')
                ->where('status', 'active')->get();
            $data['fleetClasses'] = FleetClass::query()->select('id', 'name')
                ->where('status', 'active')->get();

            return $this->extendedView('fleet.index', $data, 'fleets');
        } catch (Throwable $e) {
            Log::error('Error loading fleets: ' . $e->getMessage(), [
                'exception' => $e,
            ]);

            return back()
                ->with('flash_error', 'Unable to load fleets at this time. Please try again.');
        }
    }

    public function fleetStore(StoreFleetRequest $request)
    {
        try {
            DB::beginTransaction();

            Fleet::query()->create([
                'make_model' => $request->make_model,
                'reg_no' => $request->reg_no,
                'fleet_type_id' => $request->fleet_type_id,
                'fleet_class_id' => $request->fleet_class_id,
                'seats' => $request->seats,
                'purchase_date' => $request->purchase_date,
                'mileage' => $request->mileage,
                'status' => $request->status ?? 'active',
                'fleet_status' => $request->fleet_status ?? 'active',
            ]);

            DB::commit();

            return redirect()
                ->route('fleets.index')
                ->with('flash_success', 'Fleet created successfully');
        } catch (Throwable $e) {
            DB::rollBack();

            Log::error('Error creating fleet: ' . $e->getMessage(), [
                'request_data' => $request->all(),
                'exception' => $e,
            ]);

            return back()
                ->withInput()
                ->with('flash_error', 'Unable to create fleet at this time. Please try again.');
        }
    }

    public function fleetUpdate(UpdateFleetRequest $request, Fleet $fleet)
    {
        try {
            DB::beginTransaction();

            $fleet->update([
                'make_model' => $request->make_model,
                'reg_no' => $request->reg_no,
                'fleet_type_id' => $request->fleet_type_id,
                'fleet_class_id' => $request->fleet_class_id,
                'seats' => $request->seats,
                'purchase_date' => $request->purchase_date,
                'mileage' => $request->mileage,
                'status' => $request->status,
                'fleet_status' => $request->fleet_status ?? $fleet->fleet_status ?? 'active',
            ]);

            DB::commit();

            return redirect()
                ->route('fleets.index')
                ->with('flash_success', 'Fleet updated successfully');
        } catch (Throwable $e) {
            DB::rollBack();

            Log::error('Error updating fleet: ' . $e->getMessage(), [
                'fleet_id' => $fleet->id,
                'request_data' => $request->all(),
                'exception' => $e,
            ]);

            return back()
                ->withInput()
                ->with('flash_error', 'Unable to update fleet at this time. Please try again.');
        }
    }

    public function fleetDestroy(Fleet $fleet)
    {
        try {
            DB::beginTransaction();

            $fleet->delete();

            DB::commit();

            return redirect()
                ->route('fleets.index')
                ->with('flash_success', 'Fleet deleted successfully');
        } catch (Throwable $e) {
            DB::rollBack();

            Log::error('Error deleting fleet: ' . $e->getMessage(), [
                'fleet_id' => $fleet->id,
                'exception' => $e,
            ]);

            return back()
                ->with('flash_error', 'Unable to delete fleet at this time. Please try again.');
        }
    }

    public function fleetTypes()
    {
        try {
            $data['fleetTypes'] = FleetType::query()->select('id', 'name', 'status')->get();

            return $this->extendedView('fleet.types.index', $data, 'fleets types');
        } catch (Throwable $e) {
            Log::error('Error loading fleet types: ' . $e->getMessage(), [
                'exception' => $e,
            ]);

            return back()
                ->with('flash_error', 'Unable to load fleet types at this time. Please try again.');
        }
    }

    public function fleetTypesStore(StoreFleetTypeRequest $request)
    {
        try {
            DB::beginTransaction();

            FleetType::query()->create([
                'name' => $request->name,
                'status' => $request->status,
            ]);

            DB::commit();

            return redirect()
                ->route('fleettypes.index')
                ->with('flash_success', 'Fleet Type created successfully');
        } catch (Throwable $e) {
            DB::rollBack();

            Log::error('Error creating fleet type: ' . $e->getMessage(), [
                'request_data' => $request->all(),
                'exception' => $e,
            ]);

            return back()
                ->withInput()
                ->with('flash_error', 'Unable to create fleet type at this time. Please try again.');
        }
    }

    public function fleetTypesUpdate(UpdateFleetTypeRequest $request, FleetType $type)
    {
        try {
            DB::beginTransaction();

            $type->update([
                'name' => $request->name,
                'status' => $request->status,
            ]);

            DB::commit();

            return redirect()
                ->route('fleettypes.index')
                ->with('flash_success', 'Fleet Type updated successfully');
        } catch (Throwable $e) {
            DB::rollBack();

            Log::error('Error updating fleet type: ' . $e->getMessage(), [
                'fleet_type_id' => $type->id,
                'request_data' => $request->all(),
                'exception' => $e,
            ]);

            return back()
                ->withInput()
                ->with('flash_error', 'Unable to update fleet type at this time. Please try again.');
        }
    }

    public function fleetTypesDestroy(FleetType $type)
    {
        try {
            DB::beginTransaction();

            $type->delete();

            DB::commit();

            return redirect()
                ->route('fleettypes.index')
                ->with('flash_success', 'Fleet Type deleted successfully');
        } catch (Throwable $e) {
            DB::rollBack();

            Log::error('Error deleting fleet type: ' . $e->getMessage(), [
                'fleet_type_id' => $type->id,
                'exception' => $e,
            ]);

            return back()
                ->with('flash_error', 'Unable to delete fleet type at this time. Please try again.');
        }
    }

    public function fleetClasses()
    {
        try {
            $data['fleetClasses'] = FleetClass::query()->select('id', 'name', 'status')->get();

            return $this->extendedView('fleet.classes.index', $data, 'fleets classes');
        } catch (Throwable $e) {
            Log::error('Error loading fleet classes: ' . $e->getMessage(), [
                'exception' => $e,
            ]);

            return back()
                ->with('flash_error', 'Unable to load fleet classes at this time. Please try again.');
        }
    }

    public function fleetClassesStore(StoreFleetClassRequest $request)
    {
        try {
            DB::beginTransaction();

            FleetClass::query()->create([
                'name' => $request->name,
                'status' => $request->status,
            ]);

            DB::commit();

            return redirect()
                ->route('fleetclasses.index')
                ->with('flash_success', 'Fleet Class created successfully');
        } catch (Throwable $e) {
            DB::rollBack();

            Log::error('Error creating fleet class: ' . $e->getMessage(), [
                'request_data' => $request->all(),
                'exception' => $e,
            ]);

            return back()
                ->withInput()
                ->with('flash_error', 'Unable to create fleet class at this time. Please try again.');
        }
    }

    public function fleetClassesUpdate(UpdateFleetClassRequest $request, FleetClass $classes)
    {
        try {
            DB::beginTransaction();

            $classes->update([
                'name' => $request->name,
                'status' => $request->status,
            ]);

            DB::commit();

            return redirect()
                ->route('fleetclasses.index')
                ->with('flash_success', 'Fleet Class updated successfully');
        } catch (Throwable $e) {
            DB::rollBack();

            Log::error('Error updating fleet class: ' . $e->getMessage(), [
                'fleet_class_id' => $classes->id,
                'request_data' => $request->all(),
                'exception' => $e,
            ]);

            return back()
                ->withInput()
                ->with('flash_error', 'Unable to update fleet class at this time. Please try again.');
        }
    }

    public function fleetClassesDestroy(FleetClass $classes)
    {
        try {
            DB::beginTransaction();

            $classes->delete();

            DB::commit();

            return redirect()
                ->route('fleetclasses.index')
                ->with('flash_success', 'Fleet Class deleted successfully');
        } catch (Throwable $e) {
            DB::rollBack();

            Log::error('Error deleting fleet class: ' . $e->getMessage(), [
                'fleet_class_id' => $classes->id,
                'exception' => $e,
            ]);

            return back()
                ->with('flash_error', 'Unable to delete fleet class at this time. Please try again.');
        }
    }
}
