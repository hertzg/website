<?php

namespace Longitude;

function parse ($input) {
    $input = preg_replace('/\s+/', '', $input);
    $regex = '/^(\d+)°(\d+)′(?:(\d+)(?:\.(\d+))?″)?([WE])$/ui';
    if (preg_match($regex, $input, $match)) {
        $input = $match[1] + $match[2] / 60 +
            $match[3] / (60 * 60) + $match[4] / (60 * 60 * 100);
        if (strtolower($match[5]) == 'w') $input *= -1;
    }
    $input = max(-180, min(180, $input));
    $input = fmod($input + 180, 360) - 180;
    $input = max(-180, min(180, $input));
    return $input;
}
