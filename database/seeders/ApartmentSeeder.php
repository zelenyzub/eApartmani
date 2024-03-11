<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Apartment;

class ApartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 0; $i < 10; $i++) {
            Apartment::create([
                'apartmentName' => 'Sample Apartment ' . ($i + 1),
                'gmLocation' => 'Sample Location',
                'apartmentPhotos' => 'sample.jpg',
                'apartmentCapacity' => 4,
                'apartmentDescription' => 'This is a sample apartment description.',
                'ownerFirstName' => 'John',
                'ownerLastName' => 'Doe',
                'apartmentAddress' => '123 Sample St',
                'aditionalApartInfo' => 'Additional info goes here.',
                'wifiPassword' => 'samplePassword',
                'parking' => true
            ]);
        }        
    }
}
