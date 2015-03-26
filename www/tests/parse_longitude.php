#!/usr/bin/php
<?php

function visual_assert ($input, $correctValue) {

    include_once '../fns/Longitude/parse.php';
    $output = Longitude\parse($input);

    $exportInput = var_export($input, true);
    $exportOutput = var_export($output, true);
    $expression = "Longitude\parse($exportInput) returned $exportOutput";

    if (number_format($output, 6) === number_format($correctValue, 6)) {
        echo "OK $expression";
    } else {
        echo "FAIL $expression instead of ".var_export($correctValue, true);
    }
    echo " \n";

}

chdir(__DIR__);

visual_assert('0', 0);

visual_assert('1', 1);
visual_assert('-1', -1);

visual_assert('1.5', 1.5);
visual_assert('-1.5', -1.5);

visual_assert('90', 90);
visual_assert('-90', -90);

visual_assert('200', -180);
visual_assert('-200', -180);

visual_assert('12.345678', 12.345678);
visual_assert('-12.345678', -12.345678);

visual_assert('1 e', 1);
visual_assert('1 w', -1);

visual_assert('1 E', 1);
visual_assert('1 W', -1);

visual_assert('1°E', 1);
visual_assert('1°W', -1);

visual_assert('1 1 E', 1.016667);
visual_assert('1 1 W', -1.016667);

visual_assert('1°1 E', 1.016667);
visual_assert('1°1 W', -1.016667);

visual_assert('1 1′E', 1.016667);
visual_assert('1 1′W', -1.016667);

visual_assert('1°1′E', 1.016667);
visual_assert('1°1′W', -1.016667);

visual_assert('1 1 1 E', 1.016944);
visual_assert('1 1 1 W', -1.016944);

visual_assert('1°1 1 E', 1.016944);
visual_assert('1°1 1 W', -1.016944);

visual_assert('1 1′1 E', 1.016944);
visual_assert('1 1′1 W', -1.016944);

visual_assert('1°1′1 E', 1.016944);
visual_assert('1°1′1 W', -1.016944);

visual_assert('1 1 1″E', 1.016944);
visual_assert('1 1 1″W', -1.016944);

visual_assert('1°1 1″E', 1.016944);
visual_assert('1°1 1″W', -1.016944);

visual_assert('1 1′1″E', 1.016944);
visual_assert('1 1′1″W', -1.016944);

visual_assert('1°1′1″E', 1.016944);
visual_assert('1°1′1″W', -1.016944);

visual_assert('1 1 1.1 E', 1.016947);
visual_assert('1 1 1.1 W', -1.016947);

visual_assert('1°1 1.1 E', 1.016947);
visual_assert('1°1 1.1 W', -1.016947);

visual_assert('1 1′1.1 E', 1.016947);
visual_assert('1 1′1.1 W', -1.016947);

visual_assert('1°1′1.1 E', 1.016947);
visual_assert('1°1′1.1 W', -1.016947);

visual_assert('1 1 1.1″E', 1.016947);
visual_assert('1 1 1.1″W', -1.016947);

visual_assert('1°1 1.1″E', 1.016947);
visual_assert('1°1 1.1″W', -1.016947);

visual_assert('1 1′1.1″E', 1.016947);
visual_assert('1 1′1.1″W', -1.016947);

visual_assert('1°1′1.1″E', 1.016947);
visual_assert('1°1′1.1″W', -1.016947);
