<?php

namespace Database\Seeders;

use App\Models\Apartment;
use Illuminate\Database\Seeder;

class ApartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Apartment::truncate();

        $csvData = fopen(base_path('database/data/data.csv'), 'r');
        $firstLine = true;
        while (($data = fgetcsv($csvData)) !== false) {
            if (!$firstLine) {
                Apartment::create([
                    'name'       => $data['0'],
                    'price'      => $data['1'],
                    'bedrooms'   => $data['2'],
                    'bathrooms'  => $data['3'],
                    'storeys'    => $data['4'],
                    'garages'    => $data['5']
                ]);
            }
            $firstLine = false;
        }
    }
}
