<?php

test('api cars index returns 200', function () {
    $response = $this->get('/api/cars');

    $response->assertStatus(200);
});

test('posting invalid car data returns validation error', function () {
    // Missing required 'Name' field should trigger 422
    $response = $this->postJson('/api/cars', [
        'Cylinders' => 4,
        'Horsepower' => 100
    ]);

    $response->assertStatus(422);
});
