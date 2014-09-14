<?php

function check ($interval, $offset, $day, $expectedValue) {
    include_once __DIR__.'/../../../fns/days_left.php';
    $value = days_left($interval, $offset, $day);
    $expression = "days_left($interval, $offset, $day)";
    if ($value !== $expectedValue) {
        echo "$expression returned $value instead of $expectedValue.\n";
        die;
    }
}
