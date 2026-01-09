<?php

namespace App\Http\Controllers;

use App\Models\Car;
use Illuminate\Http\Request;

class CarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cars = Car::all();
        return $cars;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // $car = new Car();
        // $car->Name = $request->Name;
        // ...
        // $car->save();

        $validated = $request->validate([
            'Name' => 'required|string|max:255',
            'Cylinders' => 'numeric',
            'Miles_per_Gallon' => 'numeric',
            'Displacement' => 'nullable',
            'Horsepower' => 'numeric',
            'Weight_in_lbs' => 'nullable|numeric',
            'Acceleration' => 'numeric',
            'Year' => 'date',
            'Origin' => 'string'
        ]);

        // $car = Car::create($request->all());  //Mass assignment
        $car = Car::create($validated); 

        return response()->json($car, 201);
    }

    /**
     * Display the specified resource.
     */
    // public function show(Car $car) //route model binding
    // {
    //     return $car;
    // }

    // public function show($id)
    // {
    //     $car = Car::find($id);

    //     if (!$car) {
    //         return response()->json(['message' => 'No car found.'], 404);
    //     }

    //     return $car;
    // }

    public function show($id)
    {
        $car = Car::findOrFail($id);
        return $car;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Car $car)
    {
        //TODO: Validation!!!!!

        $car->update($request->all());

        return $car;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Car $car)
    {
        if ($car->delete())
        {
            return response()->noContent();
        }
        else {
            return response()->json(['Message' => 'Something went wrong.'], 400);
        }
    }

    public function findByName($name) {
        $cars = Car::where('Name', 'like', '%'.$name.'%')->get();
        if ($cars->isNotEmpty() && $cars)
        {
            return $cars;
        }
        return response()->json(['Message' => 'No car found.'], 404);
    }
}
