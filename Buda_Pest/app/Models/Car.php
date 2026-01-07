<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    // protected $table = 'autok';
    // protected $primaryKey = 'car_id';

    public $timestamps = false;

    // protected $fillable = [
    //     "Name",
    //     "Miles_per_Gallon",
    //     "Cylinders",
    //     "Displacement",
    //     "Horsepower",
    //     "Weight_in_lbs",
    //     "Acceleration",
    //     "Year",
    //     "Origin"
    // ];

    protected $guarded = [
        "id"
    ];}
