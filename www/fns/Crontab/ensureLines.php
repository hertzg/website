<?php

namespace Crontab;

function ensureLines ($ensure_lines) {

    include_once __DIR__.'/getLines.php';
    $lines = getLines();
    if ($lines === false) return false;

    foreach ($ensure_lines as $ensure_line) {
        if (!in_array($ensure_line, $lines)) $lines[] = $ensure_line;
    }

    include_once __DIR__.'/setLines.php';
    return setLines($lines);

}
