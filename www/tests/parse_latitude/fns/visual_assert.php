<?php

function visual_assert ($input, $correctValue) {

    include_once __DIR__.'/../../../fns/Latitude/parse.php';
    $output = Latitude\parse($input);

    $exportInput = var_export($input, true);
    $exportOutput = var_export($output, true);
    $expression = "Latitude\parse($exportInput) returned $exportOutput";

    if (number_format($output, 6) === number_format($correctValue, 6)) {
        echo "OK $expression";
    } else {
        echo "FAIL $expression instead of ".var_export($correctValue, true);
    }
    echo " \n";

}
