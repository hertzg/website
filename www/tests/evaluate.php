#!/usr/bin/php
<?php

function visual_assert ($expression, $expected_result) {
    $result = evaluate($expression, $error, $error_char);
    $failed = $result !== $expected_result;
    echo 'evaluate('.var_export($expression, true).') returned '.var_export($result, true);
    if ($failed) echo ' instead of '.var_export($expected_result, true);
    echo "\n";
    if ($result === false) {
        echo str_repeat('-', $error_char + 10)."^ $error\n";
    }
    echo "\n";
}

include_once __DIR__.'/../fns/evaluate.php';
visual_assert('', false);
visual_assert(' ', false);
visual_assert('  ', false);
visual_assert('   ', false);
visual_assert('a', false);
visual_assert('+', false);
visual_assert('-', false);
visual_assert('*', false);
visual_assert('/', false);
visual_assert('(', false);
visual_assert('(2', false);
visual_assert(')', false);
visual_assert('2)', false);
visual_assert('2 3', false);
visual_assert('2', 2);
visual_assert('23', 23);
visual_assert('-2', -2);
visual_assert('- 2', -2);
visual_assert('+2', false);
visual_assert('+ 2', false);
visual_assert('3 * (-2)', -6);
visual_assert('3 * (+2)', false);
visual_assert('2 + + 3', false);
visual_assert('2 + - 3', false);
visual_assert('2 + - - 3', false);
visual_assert('2 * / 3', false);
visual_assert('3 * - 2', -6);
visual_assert('1 + 2 + 3 - 4 - 5', -3);
visual_assert('2 * 3', 6);
visual_assert('3 * (- 2 - 3)', -15);
visual_assert('1 + 2 + 3 + 4 + 5', 15);
visual_assert('5 - 2', 3);
visual_assert('1 + 2 * 3', 7);
visual_assert('2 * 3 + 4', 10);
visual_assert('6 / 3', 2);
visual_assert('5 - 6 / 3', 3);
visual_assert('10 / 2 * 3', 15);
visual_assert('2 * (3 + 4)', 14);
visual_assert('2 * (3 + 4) + 3', 17);
visual_assert('2 * (3 + (7 - 1) / 2) + 3', 15);
visual_assert('40 / ((7 - 3) * 2)', 5);
visual_assert('40 / (4 * (5 - 3))', 5);
