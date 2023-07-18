<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ClientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = config('data.clients');

        foreach ($data as $phone => $name) {
            DB::table('clients')->insert([
                // "user_id",
                // "city_id",
                // "neighborhood_id",
                // "nationality_id",
                "name" => $name,
                "phone" => $phone,
                // "email",
                // "employer",
                // "zip_code",
                // "employment_type",
                // "extra_figure",
                // "housing_support",
                // "unit_number",
                "status" => 1,
                // "is_buy",
                // "creator",
                // "updater",
            ]);
        }
    }
}
