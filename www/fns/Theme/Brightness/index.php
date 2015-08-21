<?php

namespace Theme\Brightness;

function index () {
    return [
        'light' => ['title' => 'Light'],
        'dark' => ['title' => 'Dark'],
        'auto' => [
            'title' => 'Automatic',
            'description' => 'Light at daytime. Otherwise dark.',
        ],
    ];
}
