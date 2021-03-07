<?php

namespace Database\Factories;

use App\Models\Book;
use Illuminate\Database\Eloquent\Factories\Factory;

class BookFactory extends Factory {
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Book::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        return [
            'author' => $this->faker->name,
            'cover_url' => $this->faker->imageUrl(),
            'book_name' => $this->faker->sentence(3),
            'release_date' => $this->faker->date(),
            'isbn' => $this->faker->isbn10,
        ];
    }

    /**
     * @return BookFactory
     */
    public function defaultBook(): BookFactory {
        return $this->state(function () {
            return [
                'author' => 'Yassir Fadhil',
                'cover_url' => 'https://ae01.alicdn.com/kf/H1e595515e0054467ba4124ccf434f149T/2021-A5.jpg',
                'book_name' => 'About Making Ideas',
            ];
        });
    }
}