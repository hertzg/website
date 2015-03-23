#!/usr/bin/php
<?php

function visual_assert ($input, $correctValue) {

    include_once '../fns/Latitude/parse.php';
    $output = Latitude\parse($input);

    $exportInput = var_export($input, true);
    $exportOutput = var_export($output, true);
    $expression = "Latitude\parse($exportInput) returned $exportOutput";

    if ($output === $correctValue) {
        echo "OK $expression";
    } else {
        echo "FAIL $expression instead of ".var_export($correctValue, true);
    }
    echo " \n";

}

chdir(__DIR__);

visual_assert('41.34425', 41.34425);
visual_assert('-411', -90);
visual_assert('2332', 90);
visual_assert('41°43′N', 41.716666666666669);
visual_assert('17°55′28″S', -17.924444444444447);
visual_assert('51°30′2.72″n', 51.500755555555557);
