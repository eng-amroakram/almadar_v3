<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BrokerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $x = 1;

        while ($x < 500) {
            DB::table('brokers')->insert([
                "name" => "broker-" . $x,
                "phone" => "059" . random_int(1111111, 9999999),
            ]);

            $x = $x + 1;
        }
    }
}
