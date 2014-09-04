<?php

namespace Form;

function timezoneLabel ($base, $timezone) {

    $time = time();
    include_once __DIR__.'/label.php';
    include_once __DIR__.'/../Timezone/format.php';
    $content = \Timezone\format($timezone)
        .' (Local time <span class="localTime"'
        ." data-local_timezone=\"$timezone\">"
        .date('H:i, M j', $time + $timezone * 60).'</span>)';

    return label('Timezone', $content)
        .'<script type="text/javascript" async="async"'
        ." src=\"{$base}js/timezone-label.js\"></script>";

}
