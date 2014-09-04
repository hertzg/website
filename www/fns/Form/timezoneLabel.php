<?php

namespace Form;

function timezoneLabel ($timezone) {
    $time = time();
    include_once __DIR__.'/label.php';
    include_once __DIR__.'/../Timezone/format.php';
    $content = \Timezone\format($timezone)
        .' (Local time '.date('H:i, M j', $time + $timezone * 60).')';
    return label('Timezone', $content);
}
