<?php

namespace Database\Seeders;

use App\Models\Activity;
use App\Models\Carrier;
use App\Models\Driver;
use App\Models\DriverType;
use App\Models\Fleet;
use App\Models\FleetClass;
use App\Models\FleetType;
use App\Models\Lodge;
use App\Models\ServiceItem;
use App\Models\ServiceProvider;
use App\Models\Trip;
use App\Models\TripType;
use Illuminate\Database\Seeder;

class FleetActivitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create Fleet Types
        $fleetTypes = FleetType::factory(6)->create();

        // Create Fleet Classes
        $fleetClasses = FleetClass::factory(6)->create();

        // Create Fleets with relationships
        Fleet::factory(15)->recycle($fleetTypes)->recycle($fleetClasses)->create();

        // Create Driver Types
        $driverTypes = DriverType::factory(5)->create();

        // Create Drivers with relationships to Fleet and DriverType
        Driver::factory(20)->recycle($driverTypes)->recycle(Fleet::all())->create();

        // Create Lodges
        Lodge::factory(10)->create();

        // Create Activities
        Activity::factory(15)->create();

        // Create Trip Types
        TripType::factory(10)->create();

        // Create Trips with relationships
        Trip::factory(20)->recycle(TripType::all())->recycle(Driver::all())->recycle(Fleet::all())->create();

        // Create Service Items
        ServiceItem::factory(20)->create();

        // Create Carriers
        Carrier::factory(15)->create();

        // Create Service Providers
        ServiceProvider::factory(15)->create();
    }
}
