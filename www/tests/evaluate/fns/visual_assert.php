<?php

function visual_assert ($options) {

    $expression = $options['expression'];
    $expected_value = $options['expected_value'];
    $expected_pretty_expression = $options['expected_pretty_expression'];

    $key = 'value_of';
    if (array_key_exists($key, $options)) $value_of = $options[$key];
    else $value_of = null;

    $key = 'expected_resolved_expression';
    if (array_key_exists($key, $options)) {
        $expected_resolved_expression = $options[$key];
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
