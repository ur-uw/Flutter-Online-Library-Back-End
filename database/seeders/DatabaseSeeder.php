<?php

namespace Database\Seeders;

use App\Models\Book;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run(): void
    {
        $this->call(UsersTableSeeder::class);
        $this->call(BooksTableSeeder::class);
        $defaultUser=User::find(1);
        $defaultUser->books()->save(Book::find(1));
        User::all()->each(function (User $user){
            $user->books()->saveMany(Book::inRandomOrder()->limit(5)->get());
        });
    }
}
