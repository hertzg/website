<?php

function create_interval_select ($value) {

    $fnsDir = __DIR__.'/../../fns';

    include_once "$fnsDir/Schedules/limits.php";
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

    include_once "$fnsDir/Form/select.php";
    return Form\select('interval', 'Repeats in every', $options, $value);

}
