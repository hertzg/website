<?php

namespace Timezone;

function format ($value) {
    if ($value < 0) {
        $absZone = -$value;
        $sign = '-';
    } else {
        $absZone = $value;
        if ($value > 0) {
            $sign = '+';
        } else {
            $sign = '&plusmn;';
        }
    }
    $hour = floor($absZone / 60);
    $minute = str_pad($absZone % 60, 2, '0', STR_PAD_LEFT);
    return "$sign$hour:$minute";
}
