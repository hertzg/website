<?php

function nth_order ($n) {
    $lastDigit = $n % 10;
    $lastTwoDigits = $n % 100;
    if ($lastDigit == 1 && $lastTwoDigits != 11) $suffix = 'st';
    elseif ($lastDigit == 2 && $lastTwoDigits != 12) $suffix = 'nd';
    elseif ($lastDigit == 3 && $lastTwoDigits != 13) $suffix = 'rd';
    else $suffix = 'th';
    return $n.$suffix;
}
