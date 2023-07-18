<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class NationalitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = config('data.nationalities');

        foreach ($data as  $nationality) {
            DB::table('nationalities')->insert([
                'name' => $nationality,
                'created_at' => now(),
            ]);
        }
    }
}
