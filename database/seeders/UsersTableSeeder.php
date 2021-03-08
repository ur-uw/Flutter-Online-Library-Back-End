<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder {
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void {
        $defalutUser = User::factory()->defaultUser()->create();
        $defalutUser->attachRole('superadmin');
        $users = User::factory()->count(5)->create();
        foreach ($users as $user) {
            $user->attachRole('user');
        }
    }
}