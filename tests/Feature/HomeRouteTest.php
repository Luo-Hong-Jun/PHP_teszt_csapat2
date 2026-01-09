<?php

test('home page returns successful response', function () {
    $response = $this->get('/');

    $response->assertStatus(200);
});
