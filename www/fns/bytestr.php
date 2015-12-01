<?php

function bytestr ($bytes, $space = ' ') {
    $names = ['B', 'KB', 'MB', 'GB', 'TB'];
    foreach ($names as $name) {
        if ($bytes >= 1024) $bytes /= 1024;
        else {
            if (round($bytes * 10) % 10) $decimals = 1;
            else $decimals = 0;
            return number_format($bytes, $decimals).$space.$name;
        }
    }
}
