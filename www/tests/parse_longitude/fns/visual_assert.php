<?php

function visual_assert ($input, $correctValue) {

    include_once __DIR__.'/../../../fns/Longitude/parse.php';
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
