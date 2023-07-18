<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $cities = config('data.cities');

        foreach ($cities as $code => $city) {

            DB::table('cities')->insert([
                'name' => $city,
                'code' => $code,
                'status' => 1,
                'created_at' => now(),
            ]);
        }
    }
}
