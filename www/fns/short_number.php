<?php

function short_number ($number) {

    static $endings = ['k', 'm', 'b'];

    $ending = '';
    $index = 0;
    while (abs($number) >= 1000 && $index < 3) {
        $number /= 1000;
        $ending = $endings[$index];
        $index++;
    }

    if (round($number * 10) % 10) $decimals = 1;
    else $decimals = 0;

    $ten = abs($number) * 10;
    $floor_ten = floor($ten);
    if ($ten > $floor_ten) {
        if ($number < 0) $inequality = '<';
        else $inequality = '>';
    } else {
        $inequality = '';
    }

    return $inequality.number_format($number, $decimals).$ending;

}
