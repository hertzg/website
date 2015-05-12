<?php

namespace ViewPage;

function getMinMax ($bars, &$min, &$max) {

    $min = $max = 0;
    foreach ($bars as $bar) {
        $value = $bar->value;
        if ($value > $max) $max = $value;
        elseif ($value < $min) $min = $value;
    }

    $step = 100;
    $n = 0;
    while ($max > $step || $min < -$step) {
        $max /= $step;
        $min /= $step;
        $n++;
    }

    $max = ceil($max);
    $min = floor($min);

    $multiplier = pow($step, $n);
    $max *= $multiplier;
    $min *= $multiplier;

    if (!$min && !$max) {
        $max = 1;
        $min = -1;
    }

}
