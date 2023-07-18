<?php

namespace Database\Seeders;

use App\Models\City;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class RealEstateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $x = 1;
        $types = config("data.real_estate_types");
        $land_type = config("data.real_estate_location.land_types");
        $interface_length = config("data.real_estate_location.interface_lengths");
        $owner_ship_type = config("data.real_estate_location.owner_ship_types");
        $building_type = config("data.real_estate_location.building_types");
        $building_status = config("data.real_estate_location.building_statuses");
        $construction_delivery = config("data.real_estate_location.construction_deliveries");
        $property_type = config("data.real_estate_location.property_types");
        $property_status = config("data.real_estate_location.property_statuses");

        // while ($x < 100) {

        //     $city = City::find(random_int(1, 5));

        //     DB::table('real_estates')->insert([
        //         "id" => $x,
        //         "user_id" => "1",
        //         "floor" => random_int(1, 5),
        //         "floors" => random_int(1, 5),
        //         "flats" => random_int(1, 5),
        //         "flat_rooms" => random_int(1, 5),
        //         "rooms" => random_int(1, 5),
        //         "stores" => random_int(1, 5),
        //         "bathrooms" => random_int(1, 5),
        //         "interface_length" => random_int(1, 5),
        //         "age" => random_int(1, 20),
        //         "annual_income" => random_int(1, 100),
        //         "space" => random_int(1, 100),
        //         "total" => random_int(1, 100),
        //         "price" => random_int(1, 100),
        //         "price_meter" => random_int(1, 100),
        //         "notes" => Str::random(16),
        //         "land_number" => random_int(1111, 9999),
        //         "statement" => Str::random(10),
        //         "character" => Str::random(6),
        //         "block_number" => random_int(111, 999),
        //         // "directions" => json_encode([1, 2, 3]),
        //         "real_estate_type" => $types[random_int(0, 4)],
        //         "creator" => "1",
        //         "updater" => null,
        //     ]);

        //     DB::table('real_estate_locations')->insert([
        //         "user_id" => "1",
        //         "city_id" => $city->id,
        //         "neighborhood_id" => $city->neighborhoods->random()->id,
        //         "real_estate_id" => $x,
        //         "land_type" => $land_type[random_int(0, 3)],
        //         "interface_length" => $interface_length[random_int(0, 2)],
        //         "owner_ship_type" => $owner_ship_type[random_int(0, 2)],
        //         "building_type" => $building_type[random_int(0, 2)],
        //         "building_status" => $building_status[random_int(0, 1)],
        //         "construction_delivery" => $construction_delivery[random_int(0, 2)],
        //         "property_type" => $property_type[random_int(0, 8)],
        //         "property_status" => $property_status[random_int(0, 2)],
        //     ]);

        //     $x = $x + 1;
        // }
    }
}
