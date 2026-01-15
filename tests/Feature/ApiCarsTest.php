<?php

test('api cars index returns 200', function () {
    $response = $this->get('/api/cars');

    $response->assertStatus(200);
});

test('api cars index returns json data', function () {
    $response = $this->get('/api/cars');

    $response->assertHeader('Content-Type', 'application/json');
});

test('api cars show returns 200 for existing car', function () {
    $carResponse = $this->postJson('/api/cars', [
        'Name' => 'Existing Car',
        'Cylinders' => 4,
        'Miles_per_Gallon' => 24.0,
        'Horsepower' => 140,
        'Weight_in_lbs' => 2950,
        'Acceleration' => 12.0,
        'Year' => '2017-01-01',
        'Origin' => 'USA'
    ]);

    $carId = $carResponse->json('id');

    $response = $this->get("/api/cars/{$carId}");

    $response->assertStatus(200);
});

test('api cars show returns json data for existing car', function () {
    $carResponse = $this->postJson('/api/cars', [
        'Name' => 'Existing Car',
        'Cylinders' => 4,
        'Miles_per_Gallon' => 24.0,
        'Horsepower' => 140,
        'Weight_in_lbs' => 2950,
        'Acceleration' => 12.0,
        'Year' => '2017-01-01',
        'Origin' => 'USA'
    ]);

    $carId = $carResponse->json('id');

    $response = $this->get("/api/cars/{$carId}");

    $response->assertHeader('Content-Type', 'application/json');
});

test('api cars show returns 404 for non-existing car', function () {
    $response = $this->get('/api/cars/9999');

    $response->assertStatus(404);
});

test('api cars show returns html data for non-existing car', function () {
    $response = $this->get('/api/cars/9999');

    $response->assertHeader('Content-Type', 'text/html; charset=utf-8');
});

test('api cars name search returns 200 for existing car', function () {
    $carName = 'Unique Car Name';
    $this->postJson('/api/cars', [
        'Name' => $carName,
        'Cylinders' => 6,
        'Miles_per_Gallon' => 20.0,
        'Horsepower' => 160,
        'Weight_in_lbs' => 3200,
        'Acceleration' => 11.0,
        'Year' => '2016-01-01',
        'Origin' => 'USA'
    ]);

    $response = $this->get("/api/cars/car/$carName");
    $response->assertStatus(200);
});

test('api cars name search returns json data for existing car', function () {
    $carName = 'Unique Car Name';
    $this->postJson('/api/cars', [
        'Name' => $carName,
        'Cylinders' => 6,
        'Miles_per_Gallon' => 20.0,
        'Horsepower' => 160,
        'Weight_in_lbs' => 3200,
        'Acceleration' => 11.0,
        'Year' => '2016-01-01',
        'Origin' => 'USA'
    ]);

    $response = $this->get("/api/cars/car/$carName");
    $response->assertHeader('Content-Type', 'application/json');
});

test('api cars name search returns 404 for non-existing car', function () {
    $response = $this->get('/api/cars/car/NonExistingCarName12345');

    $response->assertStatus(404);
});

test('api cars name search returns json data', function () {
    $response = $this->get('/api/cars/car/NonExistingCarName12345');

    $response->assertHeader('Content-Type', 'application/json');
});

test('posting invalid car data returns validation error', function () {
    $response = $this->postJson('/api/cars', [
        'Cylinders' => 4,
        'Horsepower' => 100
    ]);

    $response->assertStatus(422);
});

test('posting invalid car data returns json data', function () {
    $response = $this->postJson('/api/cars', [
        'Cylinders' => 4,
        'Horsepower' => 100
    ]);

    $response->assertHeader('Content-Type', 'application/json');
});

test('posting valid car data creates a new car', function () {
    $carData = [
        'Name' => 'Test Car',
        'Cylinders' => 4,
        'Miles_per_Gallon' => 25.5,
        'Horsepower' => 150,
        'Weight_in_lbs' => 3000,
        'Acceleration' => 12.5,
        'Year' => '2020-01-01',
        'Origin' => 'USA'
    ];

    $response = $this->postJson('/api/cars', $carData);

    $response->assertStatus(201);
});

test('posting valid car data returns Json data', function () {
    $carData = [
        'Name' => 'Test Car',
        'Cylinders' => 4,
        'Miles_per_Gallon' => 25.5,
        'Horsepower' => 150,
        'Weight_in_lbs' => 3000,
        'Acceleration' => 12.5,
        'Year' => '2020-01-01',
        'Origin' => 'USA'
    ];

    $response = $this->postJson('/api/cars', $carData);

    $response->assertHeader('Content-Type', 'application/json');
});

test('deleting an existing car returns 204', function () {
    $carResponse = $this->postJson('/api/cars', [
        'Name' => 'Car to Delete',
        'Cylinders' => 4,
        'Miles_per_Gallon' => 20.0,
        'Horsepower' => 120,
        'Weight_in_lbs' => 2800,
        'Acceleration' => 14.0,
        'Year' => '2019-01-01',
        'Origin' => 'USA'
    ]);

    $carId = $carResponse->json('id');

    $response = $this->delete("/api/cars/{$carId}");

    $response->assertStatus(204);
});

test('deleting an existing car returns NoContent', function () {
    $carResponse = $this->postJson('/api/cars', [
        'Name' => 'Car to Delete',
        'Cylinders' => 4,
        'Miles_per_Gallon' => 20.0,
        'Horsepower' => 120,
        'Weight_in_lbs' => 2800,
        'Acceleration' => 14.0,
        'Year' => '2019-01-01',
        'Origin' => 'USA'
    ]);

    $carId = $carResponse->json('id');

    $response = $this->delete("/api/cars/{$carId}");
    $response->assertNoContent();
});

test('deleting a non-existing car returns 404', function () {
    $response = $this->delete('/api/cars/9999');

    $response->assertStatus(404);
});

test('deleting a non-existing car returns html data', function () {
    $response = $this->delete('/api/cars/9999');

    $response->assertHeader('Content-Type', 'text/html; charset=utf-8');
});

test('updating an existing car returns 200', function () {
    $carResponse = $this->postJson('/api/cars', [
        'Name' => 'Car to Update',
        'Cylinders' => 4,
        'Miles_per_Gallon' => 22.0,
        'Horsepower' => 130,
        'Weight_in_lbs' => 2900,
        'Acceleration' => 13.5,
        'Year' => '2018-01-01',
        'Origin' => 'USA'
    ]);

    $carId = $carResponse->json('id');

    $response = $this->putJson("/api/cars/{$carId}", [
        'Name' => 'Updated Car Name'
    ]);

    $response->assertStatus(200);
});

test('updating an existing car returns Json data', function () {
    $carResponse = $this->postJson('/api/cars', [
        'Name' => 'Car to Update',
        'Cylinders' => 4,
        'Miles_per_Gallon' => 22.0,
        'Horsepower' => 130,
        'Weight_in_lbs' => 2900,
        'Acceleration' => 13.5,
        'Year' => '2018-01-01',
        'Origin' => 'USA'
    ]);

    $carId = $carResponse->json('id');

    $response = $this->putJson("/api/cars/{$carId}", [
        'Name' => 'Updated Car Name'
    ]);

    $response->assertHeader('Content-Type', 'application/json');
});

