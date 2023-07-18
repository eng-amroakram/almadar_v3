<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class NeighborhoodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = config('data.neighborhoods');

        foreach ($data as $city_id => $neighborhoods) {
            foreach ($neighborhoods as $neighborhood) {
                DB::table('neighborhoods')->insert([
                    'city_id' => $city_id,
                    'name' => $neighborhood,
                    'status' => 1,
                    'created_at' => now(),
                ]);
            }
        }
    }
}
