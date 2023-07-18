<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $super_admins = config('data.users');

        foreach ($super_admins as $phone => $super_admin) {
            DB::table('users')->insert([
                'name' => $super_admin['name'],
                'phone' =>  $phone,
                'email' => $super_admin['email'],
                'password' => Hash::make($phone),
                'user_status' => 'active',
                'email_verified_at' => now(),
                'remember_token' => Str::random(10),
                'user_type' => 'superadmin',
                'verification_code' => null,
                'created_at' => now(),
                'permissions' => json_encode(config('permissions.all')),
            ]);
        }

        DB::table('users')->insert([
            'name' => "marketer",
            'phone' =>  "0599916673",
            'email' => "marketer@gmail.com",
            'password' => Hash::make("0599916673"),
            'user_status' => 'active',
            'email_verified_at' => now(),
            'remember_token' => Str::random(10),
            'user_type' => 'marketer',
            'verification_code' => null,
            'created_at' => now(),
            'permissions' => json_encode(config('permissions.marketer')),
        ]);

        DB::table('users')->insert([
            'name' => "office",
            'phone' =>  "0599916674",
            'email' => "office@gmail.com",
            'password' => Hash::make("0599916674"),
            'user_status' => 'active',
            'email_verified_at' => now(),
            'remember_token' => Str::random(10),
            'user_type' => 'office',
            'verification_code' => null,
            'created_at' => now(),
            'permissions' => json_encode(config('permissions.office')),
        ]);

        DB::table('users')->insert([
            'name' => "admin",
            'phone' =>  "0599916675",
            'email' => "admin@gmail.com",
            'password' => Hash::make("0599916675"),
            'user_status' => 'active',
            'email_verified_at' => now(),
            'remember_token' => Str::random(10),
            'user_type' => 'admin',
            'verification_code' => null,
            'created_at' => now(),
            'permissions' => json_encode(config('permissions.admin')),
        ]);

        $types = ["superadmin", "admin", 'marketer', "office"];

        // $x = 0;

        // while ($x < 3) {
        //     DB::table('users')->insert([
        //         'name' => Str::random(7),
        //         'phone' =>  "059" . random_int(1111111, 9999999),
        //         'email' => Str::random(4) . "@gmail.com",
        //         'password' => Hash::make("0599916672"),
        //         'user_status' => 'active',
        //         'email_verified_at' => now(),
        //         'remember_token' => Str::random(10),
        //         'user_type' => $types[random_int(0, 3)],
        //         'verification_code' => null,
        //         'created_at' => now(),
        //         'permissions' => json_encode(config('permissions.all')),
        //     ]);

        //     $x = $x + 1;
        // }
    }
}
