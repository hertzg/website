#!/usr/bin/php
<?php

chdir(__DIR__);
include_once '../../../lib/defaults.php';
include_once 'fns/visual_assert.php';
include_once '../../fns/evaluate.php';
visual_assert([
    'expression' => '',
    'expected_value' => false,
    'expected_pretty_expression' => null,
]);
visual_assert([
    'expression' => ' ',
    'expected_value' => false,
    'expected_pretty_expression' => null,
]);
visual_assert([
    'expression' => '  ',
    'expected_value' => false,
    'expected_pretty_expression' => null,
]);
visual_assert([
    'expression' => '   ',
    'expected_value' => false,
    'expected_pretty_expression' => null,
]);
visual_assert([
    'expression' => 'a',
    'expected_value' => false,
    'expected_pretty_expression' => null,
]);
visual_assert([
    'expression' => '+',
    'expected_value' => false,
    'expected_pretty_expression' => null,
]);
visual_assert([
    'expression' => '-',
    'expected_value' => false,
    'expected_pretty_expression' => null,
]);
visual_assert([
    'expression' => '*',
    'expected_value' => false,
    'expected_pretty_expression' => null,
]);
visual_assert([
    'expression' => '/',
    'expected_value' => false,
    'expected_pretty_expression' => null,
]);
visual_assert([
    'expression' => '(',
    'expected_value' => false,
    'expected_pretty_expression' => null,
]);
visual_assert([
    'expression' => '(2',
    'expected_value' => false,
    'expected_pretty_expression' => null,
]);
visual_assert([
    'expression' => ')',
    'expected_value' => false,
    'expected_pretty_expression' => null,
]);
visual_assert([
    'expression' => '2)',
    'expected_value' => false,
    'expected_pretty_expression' => null,
]);
visual_assert([
    'expression' => '()',
    'expected_value' => false,
    'expected_pretty_expression' => null,
]);
visual_assert([
    'expression' => '1 + 2',
    'expected_value' => 3.0,
    'expected_pretty_expression' => '1 + 2',
]);
visual_assert([
    'expression' => '(1 + 2)',
    'expected_value' => 3.0,
    'expected_pretty_expression' => '(1 + 2)',
]);
visual_assert([
    'expression' => '2 + ()',
    'expected_value' => false,
    'expected_pretty_expression' => null,
]);
visual_assert([
    'expression' => '2 + (( ))',
    'expected_value' => false,
    'expected_pretty_expression' => null,
]);
visual_assert([
    'expression' => '2 3',
    'expected_value' => false,
    'expected_pretty_expression' => null,
]);
visual_assert([
    'expression' => '2 +',
    'expected_value' => false,
    'expected_pretty_expression' => null,
]);
visual_assert([
    'expression' => '2 + 3 +',
    'expected_value' => false,
    'expected_pretty_expression' => null,
]);
visual_assert([
    'expression' => '2(3)',
    'expected_value' => false,
    'expected_pretty_expression' => null,
]);
visual_assert([
    'expression' => '2 (3)',
    'expected_value' => false,
    'expected_pretty_expression' => null,
]);
visual_assert([
    'expression' => '2 + (3 (4))',
    'expected_value' => false,
    'expected_pretty_expression' => null,
]);
visual_assert([
    'expression' => '2 + (3) (4)',
    'expected_value' => false,
    'expected_pretty_expression' => null,
]);
visual_assert([
    'expression' => '0',
    'expected_value' => 0.0,
    'expected_pretty_expression' => '0',
]);
visual_assert([
    'expression' => '2',
    'expected_value' => 2.0,
    'expected_pretty_expression' => '2',
]);
visual_assert([
    'expression' => '2.5',
    'expected_value' => 2.5,
    'expected_pretty_expression' => '2.5',
]);
visual_assert([
    'expression' => '2.5 + 1.5',
    'expected_value' => 4.0,
    'expected_pretty_expression' => '2.5 + 1.5',
]);
visual_assert([
    'expression' => '23',
    'expected_value' => 23.0,
    'expected_pretty_expression' => '23',
]);
visual_assert([
    'expression' => '-2',
    'expected_value' => -2.0,
    'expected_pretty_expression' => '-2',
]);
visual_assert([
    'expression' => '- 2',
    'expected_value' => -2.0,
    'expected_pretty_expression' => '-2',
]);
visual_assert([
    'expression' => '+2',
    'expected_value' => false,
    'expected_pretty_expression' => null,
]);
visual_assert([
    'expression' => '+ 2',
    'expected_value' => false,
    'expected_pretty_expression' => null,
]);
visual_assert([
    'expression' => '3 * (-2)',
    'expected_value' => -6.0,
    'expected_pretty_expression' => '3 * (-2)',
]);
visual_assert([
    'expression' => '3 * (+2)',
    'expected_value' => false,
    'expected_pretty_expression' => null,
]);
visual_assert([
    'expression' => '2 + + 3',
    'expected_value' => false,
    'expected_pretty_expression' => null,
]);
visual_assert([
    'expression' => '2 + - 3',
    'expected_value' => false,
    'expected_pretty_expression' => null,
]);
visual_assert([
    'expression' => '2 + - - 3',
    'expected_value' => false,
    'expected_pretty_expression' => null,
]);
visual_assert([
    'expression' => '2 * / 3',
    'expected_value' => false,
    'expected_pretty_expression' => null,
]);
visual_assert([
    'expression' => '3 * - 2',
    'expected_value' => -6.0,
    'expected_pretty_expression' => '3 * -2',
]);
visual_assert([
    'expression' => '1 + 2 + 3 - 4 - 5',
    'expected_value' => -3.0,
    'expected_pretty_expression' => '1 + 2 + 3 - 4 - 5',
]);
visual_assert([
    'expression' => '2 * 3',
    'expected_value' => 6.0,
    'expected_pretty_expression' => '2 * 3',
]);
visual_assert([
    'expression' => '3 * (- 2 - 3)',
    'expected_value' => -15.0,
    'expected_pretty_expression' => '3 * (-2 - 3)',
]);
visual_assert([
    'expression' => '1 + 2 + 3 + 4 + 5',
    'expected_value' => 15.0,
    'expected_pretty_expression' => '1 + 2 + 3 + 4 + 5',
]);
visual_assert([
    'expression' => '5 - 2',
    'expected_value' => 3.0,
    'expected_pretty_expression' => '5 - 2',
]);
visual_assert([
    'expression' => '1 + 2 * 3',
    'expected_value' => 7.0,
    'expected_pretty_expression' => '1 + 2 * 3',
]);
visual_assert([
    'expression' => '2 * 3 + 4',
    'expected_value' => 10.0,
    'expected_pretty_expression' => '2 * 3 + 4',
]);
visual_assert([
    'expression' => '6 / 3',
    'expected_value' => 2.0,
    'expected_pretty_expression' => '6 / 3',
]);
visual_assert([
    'expression' => '5 - 6 / 3',
    'expected_value' => 3.0,
    'expected_pretty_expression' => '5 - 6 / 3',
]);
visual_assert([
    'expression' => '10 / 2 * 3',
    'expected_value' => 15.0,
    'expected_pretty_expression' => '10 / 2 * 3',
]);
visual_assert([
    'expression' => '2 * (3 + 4)',
    'expected_value' => 14.0,
    'expected_pretty_expression' => '2 * (3 + 4)',
]);
visual_assert([
    'expression' => '2 * (3 + 4) + 3',
    'expected_value' => 17.0,
    'expected_pretty_expression' => '2 * (3 + 4) + 3',
]);
visual_assert([
    'expression' => '2 * (3 + (7 - 1) / 2) + 3',
    'expected_value' => 15.0,
    'expected_pretty_expression' => '2 * (3 + (7 - 1) / 2) + 3',
]);
visual_assert([
    'expression' => '   2  *    (  3  +  ( 7-1)/2)+ 3',
    'expected_value' => 15.0,
    'expected_pretty_expression' => '2 * (3 + (7 - 1) / 2) + 3',
]);
visual_assert([
    'expression' => '40 / ((7 - 3) * 2)',
    'expected_value' => 5.0,
    'expected_pretty_expression' => '40 / ((7 - 3) * 2)',
]);
visual_assert([
    'expression' => '40 / (4 * (5 - 3))',
    'expected_value' => 5.0,
    'expected_pretty_expression' => '40 / (4 * (5 - 3))',
]);
visual_assert([
    'expression' => '2 + 1 / 0 - 5',
    'expected_value' => false,
    'expected_pretty_expression' => null,
]);
visual_assert([
    'expression' => '2 / (4 - 4)',
    'expected_value' => false,
    'expected_pretty_expression' => null,
]);
visual_assert([
    'expression' => '2 + #',
    'expected_value' => false,
    'expected_pretty_expression' => null,
]);
visual_assert([
    'expression' => '2 + #123',
    'expected_value' => 5.0,
    'expected_pretty_expression' => '2 + #123',
    'expected_resolved_expression' => '2 + 3',
    'value_of' => function ($id) {
        if ($id === '123') return 3;
    },
]);
