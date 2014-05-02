<?php

function create_interval_select ($value) {

    include_once __DIR__.'/../../fns/Schedules/limits.php';
    $limits = Schedules\limits();

    $options = [];
    for ($i = $limits['minInterval']; $i <= $limits['maxInterval']; $i++) {
        $options[$i] = "$i days";
    }

    include_once __DIR__.'/../../fns/Form/select.php';
    return Form\select('day_interval', 'Repeat in every', $options, $value);

}
