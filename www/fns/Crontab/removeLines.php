<?php

namespace Crontab;

function removeLines ($remove_lines) {

    include_once __DIR__.'/getLines.php';
    $lines = getLines();
    if ($lines === false) return false;

    $lines = array_filter($lines, function ($line) use ($remove_lines) {
        return !in_array($line, $remove_lines);
    });

    include_once __DIR__.'/setLines.php';
    return setLines($lines);

}
