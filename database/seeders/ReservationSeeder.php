<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Reservation;
use Faker\Factory as Faker;

class ReservationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        for ($i = 0; $i < 50; $i++) {
            Reservation::create([
                'apart_id' => $faker->numberBetween(1, 10), // Nasumičan ID apartmana između 1 i 10
                'guestFirstName' => $faker->firstName,
                'guestLastName' => $faker->lastName,
                'date_start' => $faker->dateTimeBetween('-1 month', '+1 month')->format('Y-m-d'),
                'date_end' => $faker->dateTimeBetween('+1 day', '+2 months')->format('Y-m-d'),
                'fullPrice' => $faker->randomFloat(2, 50, 500), // Nasumična cena između 50 i 500
                'taxPrice' => $faker->randomFloat(2, 5, 50), // Nasumična cena poreza između 5 i 50
                'guestNumber' => $faker->numberBetween(1, 5), // Nasumičan broj gostiju između 1 i 5
                'arrivalTime' => $faker->time('H:i:s'),
                'guestRegistered' => $faker->boolean,
                'reservationType' => $faker->randomElement(['booking', 'airbnb', 'private']),
                'guestPaid' => $faker->boolean,
                'guestHasCar' => $faker->boolean,
                'guestDescription' => $faker->sentence,
                'checkRole' => $faker->boolean
            ]);
        }
    }
}
