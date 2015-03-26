#!/usr/bin/php
<?php

function visual_assert ($input, $correctValue) {

    include_once '../fns/Longitude/parse.php';
    $output = Longitude\parse($input);

    $exportInput = var_export($input, true);
    $exportOutput = var_export($output, true);
    $expression = "Longitude\parse($exportInput) returned $exportOutput";

    if ($output === $correctValue) {
        echo "OK $expression";
    } else {
        echo "FAIL $expression instead of ".var_export($correctValue, true);
    }
    echo " \n";

}

chdir(__DIR__);

// TODO make better tests
visual_assert('-411', -180);
visual_assert('2332', -180);
visual_assert('41.34425', 41.344249999999988);
visual_assert('75°W', -75);
visual_assert('0°7′28.78″W', -0.12466111111112355);
