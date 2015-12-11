<?php

function visual_assert ($config) {

    $expression = $config['expression'];
    $expected_value = $config['expected_value'];
    $expected_pretty_expression = $config['expected_pretty_expression'];

    $key = 'value_of';
    if (array_key_exists($key, $config)) $value_of = $config[$key];
    else $value_of = null;

    $key = 'expected_resolved_expression';
    if (array_key_exists($key, $config)) {
        $expected_resolved_expression = $config[$key];
    } else {
        $expected_resolved_expression = $expected_pretty_expression;
    }

    $result = evaluate($expression, $error, $error_char,
        $pretty_expression, $resolved_expression, $value_of);

    $failed = $result !== $expected_value;
    if ($failed) echo 'FAIL: ';
    echo 'evaluate('.var_export($expression, true).')'
        .' returned '.var_export($result, true);
    if ($failed) echo ' instead of '.var_export($expected_value, true);
    echo "\n";

    if ($pretty_expression !== $expected_pretty_expression) {
        echo 'FAIL: Pretty expression should have been '
            .var_export($expected_pretty_expression, true)
            .' but got '.var_export($pretty_expression, true)."\n";
    }

    if ($resolved_expression !== $expected_resolved_expression) {
        echo 'FAIL: Pretty expression should have been '
            .var_export($expected_pretty_expression, true)
            .' but got '.var_export($pretty_expression, true)."\n";
    }

    if ($result === false) {
        echo str_repeat('-', $error_char + 10)."^ $error\n";
    }
    echo "\n";

}
