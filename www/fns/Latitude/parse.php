<?php

namespace Latitude;

function parse ($input) {
    $input = preg_replace('/\s+/', '', $input);
    $regex = '/^(\d+)°(?:(\d+)′(?:(\d+)(?:\.(\d+))?″)?)?([NS])$/ui';
    if (preg_match($regex, $input, $match)) {
        $input = $match[1] + $match[2] / 60 +
            $match[3] / (60 * 60) + $match[4] / (60 * 60 * 100);
        if (strtolower($match[5]) == 's') $input *= -1;
    }
    return max(-90, min(90, (float)$input));
}
