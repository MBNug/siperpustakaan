<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $is_exist = User::all();

        if (!$is_exist->count()) {
            $password = env('ADMIN_SEED_PASSWORD');
            if (empty($password)) {
                if (app()->environment('production')) {
                    $password = Str::random(16);
                    $this->command?->warn("Generated random admin password: {$password}");
                } else {
                    $password = 'admin';
                }
            }

            $admin = new User([
                'name' => 'Admin',
                'email' => env('ADMIN_SEED_EMAIL', 'admin@gmail.com'),
                'password' => bcrypt($password),
            ]);
            $admin->save();
        }
    }
}
