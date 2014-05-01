<?php

function create_interval_select ($value) {

    $options = [];
    for ($i = 2; $i <= 14; $i++) {
        $options[$i] = "$i days";
    }

    include_once __DIR__.'/../../fns/Form/select.php';
    return Form\select('day_interval', 'Repeat in every', $options, $value);

}
