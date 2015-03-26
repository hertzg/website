<?php

namespace Latitude;

function parse ($input) {
    $separator1 = '(?:° ?| )';
    $separator2 = '(?:′ ?| )';
    $separator3 = '(?:″ ?| )';
    $secondPart = '(?:(\d+)(?:\.(\d+))?'.$separator3.')?';
    $minutePart = '(?:(\d+)'.$separator2.$secondPart.')?';
    $regex = '/^(\d+)'.$separator1.$minutePart.'([ns])$/ui';
    if (preg_match($regex, $input, $match)) {
        $input = $match[1] + $match[2] / 60 +
            $match[3] / (60 * 60) + $match[4] / (60 * 60 * 100);
        if (strtolower($match[5]) == 's') $input *= -1;
    }
    return max(-90, min(90, (float)$input));

}
