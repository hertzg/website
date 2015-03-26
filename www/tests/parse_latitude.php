#!/usr/bin/php
<?php

function visual_assert ($input, $correctValue) {

    include_once '../fns/Latitude/parse.php';
    $output = Latitude\parse($input);

    $exportInput = var_export($input, true);
    $exportOutput = var_export($output, true);
    $expression = "parse($exportInput) returned $exportOutput";

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

visual_assert('100', 90);
visual_assert('-100', -90);

visual_assert('12.345678', 12.345678);
visual_assert('-12.345678', -12.345678);

visual_assert('1 n', 1);
visual_assert('1 s', -1);

visual_assert('1 N', 1);
visual_assert('1 S', -1);

visual_assert('1°N', 1);
visual_assert('1°S', -1);

visual_assert('1 1 N', 1.016667);
visual_assert('1 1 S', -1.016667);

visual_assert('1°1 N', 1.016667);
visual_assert('1°1 S', -1.016667);

visual_assert('1 1′N', 1.016667);
visual_assert('1 1′S', -1.016667);

visual_assert('1°1′N', 1.016667);
visual_assert('1°1′S', -1.016667);

visual_assert('1 1 1 N', 1.016944);
visual_assert('1 1 1 S', -1.016944);

visual_assert('1°1 1 N', 1.016944);
visual_assert('1°1 1 S', -1.016944);

visual_assert('1 1′1 N', 1.016944);
visual_assert('1 1′1 S', -1.016944);

visual_assert('1°1′1 N', 1.016944);
visual_assert('1°1′1 S', -1.016944);

visual_assert('1 1 1″N', 1.016944);
visual_assert('1 1 1″S', -1.016944);

visual_assert('1°1 1″N', 1.016944);
visual_assert('1°1 1″S', -1.016944);

visual_assert('1 1′1″N', 1.016944);
visual_assert('1 1′1″S', -1.016944);

visual_assert('1°1′1″N', 1.016944);
visual_assert('1°1′1″S', -1.016944);

visual_assert('1 1 1.1 N', 1.016947);
visual_assert('1 1 1.1 S', -1.016947);

visual_assert('1°1 1.1 N', 1.016947);
visual_assert('1°1 1.1 S', -1.016947);

visual_assert('1 1′1.1 N', 1.016947);
visual_assert('1 1′1.1 S', -1.016947);

visual_assert('1°1′1.1 N', 1.016947);
visual_assert('1°1′1.1 S', -1.016947);

visual_assert('1 1 1.1″N', 1.016947);
visual_assert('1 1 1.1″S', -1.016947);

visual_assert('1°1 1.1″N', 1.016947);
visual_assert('1°1 1.1″S', -1.016947);

visual_assert('1 1′1.1″N', 1.016947);
visual_assert('1 1′1.1″S', -1.016947);

visual_assert('1°1′1.1″N', 1.016947);
visual_assert('1°1′1.1″S', -1.016947);
