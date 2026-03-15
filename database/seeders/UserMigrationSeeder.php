<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserMigrationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $oldUsers = DB::table('user')->get();

        foreach ($oldUsers as $user) {
            DB::table('users')->updateOrInsert(
                ['email' => $user->user_email],
                [
                    'id' => $user->user_id,
                    'name' => $user->user_full,
                    'password' => $user->user_pass,
                    'role' => $user->user_role,
                    'status' => $user->user_status,
                    'notif' => $user->user_notif,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]
            );
        }
    }
}
