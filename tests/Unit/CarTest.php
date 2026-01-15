<?php

use App\Models\Car;

test('car model has expected default properties', function () {
    $car = new Car();

    expect($car->timestamps)->toBeFalse();
    expect($car->getGuarded())->toContain('id');
});

test('car model does not use timestamps', function () {
    $car = new Car();

    expect($car->timestamps)->toBeFalse();
    expect(property_exists($car, 'created_at'))->toBeFalse();
    expect(property_exists($car, 'updated_at'))->toBeFalse();
});

test('car id is guarded', function () {
    $car = new Car();
    $guarded = $car->getGuarded();

    expect($guarded)->toContain('id');
});

test('car model is instance of model', function () {
    $car = new Car();

    expect($car)->toBeInstanceOf(\Illuminate\Database\Eloquent\Model::class);
});

test('car can access table name', function () {
    $car = new Car();
    $table = $car->getTable();

    expect($table)->toBe('cars');
});

test('car model primary key is id', function () {
    $car = new Car();

    expect($car->getKeyName())->toBe('id');
});

test('car model is incrementing', function () {
    $car = new Car();

    expect($car->getIncrementing())->toBeTrue();
});

test('car attributes is empty array initially', function () {
    $car = new Car();

    expect($car->getAttributes())->toBeArray();
});

test('car guarded prevents mass assignment of id', function () {
    $car = new Car();
    $guarded = $car->getGuarded();

    expect(in_array('id', $guarded))->toBeTrue();
    expect(count($guarded))->toBeGreaterThan(0);
});

test('car has no fillable attributes defined', function () {
    $car = new Car();
    $fillable = $car->getFillable();

    expect($fillable)->toBeArray();
});

test('car connection name can be null or string', function () {
    $car = new Car();
    $connection = $car->getConnectionName();

    expect($connection === null || is_string($connection))->toBeTrue();
});

test('car key type is integer', function () {
    $car = new Car();

    expect($car->getKeyType())->toBe('int');
});

test('car table has cars naming convention', function () {
    $car = new Car();

    expect($car->getTable())->toBe('cars');
});

test('car can have attributes set dynamically', function () {
    $car = new Car();
    $car->setAttribute('name', 'Tesla');

    expect($car->getAttribute('name'))->toBe('Tesla');
});

test('car model has forceDelete method from eloquent', function () {
    $car = new Car();

    expect(method_exists($car, 'forceDelete'))->toBeTrue();
});

test('car timestamps property is false', function () {
    $car = new Car();

    expect($car->timestamps)->toBe(false);
});

test('car can be instantiated multiple times', function () {
    $car1 = new Car();
    $car2 = new Car();

    expect($car1)->toBeInstanceOf(Car::class);
    expect($car2)->toBeInstanceOf(Car::class);
    expect($car1)->not->toBe($car2);
});

test('car model returns correct primary key name', function () {
    $car = new Car();

    expect($car->getKeyName())->toBe('id');
    expect($car->getQualifiedKeyName())->toBe('cars.id');
});
