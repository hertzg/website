<?php

namespace ViewPage;

function getRange ($bars, &$min, &$max, &$step) {

    $min = $max = 0;
    foreach ($bars as $bar) {
        $value = $bar->value;
        if ($value > $max) $max = $value;
        elseif ($value < $min) $min = $value;
    }

    $snap = function ($value, &$step) {

        $round = pow(10, ceil(log($value, 10)));
        $value /= $round;

        if ($value <= 0.15) {
            $value = 0.15;
            $steps = 3;
        } elseif ($value <= 0.2) {
            $value = 0.2;
            $steps = 4;
        } elseif ($value <= 0.3) {
            $value = 0.3;
            $steps = 3;
        } elseif ($value <= 0.4) {
            $value = 0.4;
            $steps = 4;
        } elseif ($value <= 0.5) {
            $value = 0.5;
            $steps = 5;
        } elseif ($value <= 0.6) {
            $value = 0.6;
            $steps = 3;
        } elseif ($value <= 0.8) {
            $value = 0.8;
            $steps = 4;
        } else {
            $value = 1;
            $steps = 5;
        }

        $value *= $round;
        $step = $value / $steps;

        return $value;

    };

    if ($max) {
        $max = $snap($max, $max_step);
        if ($min) {
            $min = -$snap(-$min, $min_step);
            if ($max_step > $min_step) {
                $step = $max_step;
                $min = floor($min / $step) * $step;
            } else {
                $step = $min_step;
                $max = ceil($max / $step) * $step;
            }
        } else {
            $step = $max_step;
        }
    } else {
        if ($min) {
            $min = -$snap(-$min, $step);
        } else {
            $max = 1;
            $min = -1;
            $step = 0.5;
        }
    }

}
