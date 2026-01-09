<?php

use App\Models\Car;

test('car model has expected default properties', function () {
    $car = new Car();

    expect($car->timestamps)->toBeFalse();
    expect($car->getGuarded())->toContain('id');
});
