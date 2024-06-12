<?php

namespace Database\Seeders;

use App\Models\Parking;
use App\Models\ParkingLot;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ParkingLotSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        ParkingLot::factory()
            ->count(5) // Create 5 parking lots
            ->has(Parking::factory()->count(10)) // Each with 10 parking spots
            ->create();
    }
}
