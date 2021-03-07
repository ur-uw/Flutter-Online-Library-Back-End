<?php

namespace Database\Seeders;

use App\Models\Book;
use App\Models\User;
use Illuminate\Database\Seeder;

class BookUserTableSeeder extends Seeder {
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        $defaultUser = User::find(1);
        $defaultUser->books()->save(Book::find(1));
        User::all()->each(function (User $user) {
            $user->books()->saveMany(Book::inRandomOrder()->limit(5)->get());
        });
    }
}
