<?php

use App\Models\User;
use Illuminate\Support\Facades\Hash;

test('user factory creates a valid user', function () {
    $user = User::factory()->make();

    expect($user)->toBeInstanceOf(User::class);
    expect($user->name)->toBeString();
    expect($user->email)->toContain('@');
    expect(Hash::check('password', $user->password))->toBeTrue();
});
