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

        $round = pow(10, ceil(log($value, 10)) - 1);
        $value /= $round;

        if ($value <= 1.5) {
            $value = 1.5;
            $steps = 3;
        } elseif ($value <= 2) {
            $value = 2;
            $steps = 4;
        } elseif ($value <= 2.5) {
            $value = 2.5;
            $steps = 5;
        } elseif ($value <= 3) {
            $value = 3;
            $steps = 3;
        } elseif ($value <= 4) {
            $value = 4;
            $steps = 4;
        } elseif ($value <= 5) {
            $value = 5;
            $steps = 5;
        } elseif ($value <= 6) {
            $value = 6;
            $steps = 3;
        } elseif ($value <= 8) {
            $value = 8;
            $steps = 4;
        } else {
            $value = 10;
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
