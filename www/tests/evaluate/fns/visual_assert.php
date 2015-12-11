<?php

function visual_assert ($config) {

    extract($config);

    $result = evaluate($expression, $error,
        $error_char, $pretty_expression, $value_of);

    $failed = $result !== $expected_value;
    echo 'evaluate('.var_export($expression, true).') returned '.var_export($result, true);
    if ($failed) echo ' instead of '.var_export($expected_value, true);
    echo "\n";
    if ($pretty_expression !== $expected_pretty_expression) {
        echo 'FAIL: Pretty expression should have been '
            .var_export($expected_pretty_expression, true)
            .' but got '.var_export($pretty_expression, true)."\n";
    }
    if ($result === false) {
        echo str_repeat('-', $error_char + 10)."^ $error\n";
    }
    echo "\n";

}
