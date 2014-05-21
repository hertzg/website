<?php

function create_interval_select ($value) {

    include_once __DIR__.'/../../fns/Schedules/limits.php';
    $limits = Schedules\limits();

    $maxInterval = $limits['maxInterval'];
    $options = [];

    $max = min($maxInterval, 30);
    for ($i = $limits['minInterval']; $i <= $max; $i++) {
        $options[$i] = "$i days";
    }

    for ($i = 30; $i <= $limits['maxInterval']; $i += 30) {
        $options[$i] = "$i days";
    }

    include_once __DIR__.'/../../fns/Form/select.php';
    return Form\select('interval', 'Repeats in every', $options, $value);

}
