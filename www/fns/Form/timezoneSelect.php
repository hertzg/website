<?php

namespace Form;

function timezoneSelect ($name, $text, $value, $emptyOption = false) {

    include_once __DIR__.'/../Timezone/index.php';
    $zones = \Timezone\index();

    $options = [];
    if ($emptyOption) $options[''] = '';
    include_once __DIR__.'/../Timezone/format.php';
    foreach ($zones as $zone) {
        $options[$zone] = \Timezone\format($zone);
    }

    include_once __DIR__.'/select.php';
    return select($name, $text, $options, $value);

}
