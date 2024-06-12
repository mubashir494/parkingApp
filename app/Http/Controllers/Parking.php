<?php

namespace App\Http\Controllers;

use App\Models\Parking as ModelsParking;
use App\Models\ParkingLot;
use Illuminate\Http\Request;

class Parking extends Controller
{
    /**
     * Controller Responsible for Parking vehicle
     */
    public function park($id)
    {
        // Find the parking in the database
        $spot = ModelsParking::find($id);

        // Check if the Spot Exist
        if($spot == null){
            return response()->json(["messege" => "Spot Not Found"],400);
        }

        // Check if Spot is available
        if($spot->is_occupied){
            return response()->json(["messege" => "Spot is occupied"],400);
        }

        // Change is_occupied value to true
        $spot->is_occupied = true;
        $spot->save();

        // Return the success messege
        return response()->json(["messege" => "Successfully Reserved the Spot"]);
    }

    /**
     * Controller Responsible for un-parking vehicle
     */
    public function unPark($id)
    {
        // Find the parking in the database
        $spot = ModelsParking::find($id);

        // Check if the Spot Exist
        if($spot == null){
            return response()->json(["messege" => "Spot Not Found"],400);
        }

        // Check if Spot is available
        if($spot->is_occupied == false){
            return response()->json(["messege" => "Spot is not occupied"],400);
        }

        // Change is_occupied value to false
        $spot->is_occupied = false;
        $spot->save();

        // Return the success messege
        return response()->json(["messege" => "Successfully un-parked the Vehicle"]);
    }

    /**
     * Controller Responsible for getting list of parking lots
     */
    public function getAllParking()
    {
        // Get All the Parking
        $lots = ParkingLot::with('parking')->get();

        // Loop through the data
        $data = $lots->map(function ($lot) {
            // Get total Number of Spots 
            $totalSpots = $lot->parking->count();
            
            //Get total Number of available Spots
            $availableSpots = $lot->parking->where('is_occupied', false)->count();
            
            // return the result
            return [
                'id' => $lot->id,
                'name' => $lot->parkingLot_name,
                'total_spots' => $totalSpots,
                'available_spots' => $availableSpots,
                'spots' => $lot->parking
            ];
        });
        
        // Return the data
        return response()->json($data);
    }

}
