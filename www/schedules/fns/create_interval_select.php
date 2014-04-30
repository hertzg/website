<?php

function create_interval_select ($value) {
    include_once __DIR__.'/../../fns/Form/select.php';
    return Form\select('time_interval', 'Repeat in every', [
        '2' => '2 days',
        '3' => '3 days',
        '4' => '4 days',
        '5' => '5 days',
        '6' => '6 days',
        '7' => '7 days',
        '8' => '8 days',
        '9' => '9 days',
        '10' => '10 days',
        '11' => '11 days',
        '12' => '12 days',
        '13' => '13 days',
        '14' => '14 days',
    ], $value);
}
