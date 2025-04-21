<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CarController extends Controller
{
    public function searchCars(Request $request)
    {
        // Aquí puedes obtener los datos del formulario
        $pickupDate = $request->input('pickup_date');
        $dropoffDate = $request->input('dropoff_date');
        $seatNumber = $request->input('seat_number');
        $age = $request->input('age');

        return view('car-list', compact('pickupDate', 'dropoffDate', 'seatNumber', 'age'));
    }
}
