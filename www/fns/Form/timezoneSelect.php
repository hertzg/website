<?php

namespace Form;

function timezoneSelect ($name, $text, $value) {

    include_once __DIR__.'/../Timezone/index.php';
    $zones = \Timezone\index();

    $options = [];
    include_once __DIR__.'/../Timezone/format.php';
    foreach ($zones as $zone) {
        $options[$zone] = \Timezone\format($zone);
    }

    include_once __DIR__.'/select.php';
    return select($name, $text, $options, $value);

}
