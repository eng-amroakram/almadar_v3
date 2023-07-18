<?php

namespace Database\Seeders;

use App\Models\Branch;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BranchSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $branches = config('data.branches');
        foreach ($branches as $code => $branch) {
            DB::table('branches')->insert([
                'name' => $branch,
                'code' => ucwords($code),
                'city_id' => random_int(1, 6),
                'created_at' => now(),
            ]);
        }

        $users = User::all();

        $branches_ids = Branch::all()->pluck('id')->toArray();

        foreach ($users as $user) {
            $user->branches()->sync($branches_ids);
        }
    }
}
