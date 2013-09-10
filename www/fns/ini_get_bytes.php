<?php

function ini_get_bytes ($varname) {
    $value = ini_get($varname);
    if (preg_match('/^(\d+)([KMG])$/', $value, $match)) {
        if ($match[2] == 'K') {
            $multiplier = 1024;
        } elseif ($match[2] == 'M') {
            $multiplier = 1024 * 1024;
        } else {
            $multiplier = 1024 * 1024 * 1024;
        }
        $value = $match[1] * $multiplier;
    }
    return $value + 0;
}
