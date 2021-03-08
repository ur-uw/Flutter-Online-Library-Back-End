<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = User::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        $imageNumber=random_int(0, 10);
        $imageGender=array('men','women');
        $imageGenderIndex=array_rand($imageGender);
        return [
            'name' => $this->faker->name,
            'email' => $this->faker->unique()->safeEmail,
            'date_of_birth' => $this->faker->dateTimeBetween('-50 years', 'now'),
            'profile_image' => "https://randomuser.me/api/portraits/${imageGender[$imageGenderIndex]}/${imageNumber}.jpg",
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
        ];
    }

    public function defaultUser(): UserFactory
    {
        return $this->state(function () {
            return [
                'name' => 'Mohammed Fadhil',
                'email' => 'test@test.com',
                'email_verified_at' => now(),
                'date_of_birth' => '2000-11-03',
                'password' => bcrypt('testtest'), // testtest
            ];
        });
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return Factory
     */
    public function unverified(): Factory
    {
        return $this->state(function (array $attributes) {
            return [
                'email_verified_at' => null,
            ];
        });
    }
}
