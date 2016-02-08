<?php

function ini_get_bytes ($varname) {
    $value = ini_get($varname);
    if (preg_match('/^(\d+)([kmg])$/i', $value, $match)) {
        $suffix = strtolower($match[2]);
        if ($suffix === 'k') $multiplier = 1024;
        elseif ($suffix === 'm') $multiplier = 1024 * 1024;
        else $multiplier = 1024 * 1024 * 1024;
        $value = $match[1] * $multiplier;
    }
    return (int)$value;
}
