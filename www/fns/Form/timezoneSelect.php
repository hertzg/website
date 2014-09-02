<?php

namespace Form;

function timezoneSelect ($name, $text, $value) {

    include_once __DIR__.'/../Timezone/index.php';
    $zones = \Timezone\index();

    $options = [];
    foreach ($zones as $zone) {
        if ($zone < 0) {
            $absZone = -$zone;
            $sign = '-';
        } else {
            $absZone = $zone;
            if ($zone > 0) {
                $sign = '+';
            } else {
                $sign = '&plusmn;';
            }
        }
        $hour = floor($absZone / 60);
        $minute = str_pad($absZone % 60, 2, '0', STR_PAD_LEFT);
        $options[$zone] = "$sign$hour:$minute";
    }

    include_once __DIR__.'/select.php';
    return select($name, $text, $options, $value);

}
