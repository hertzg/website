<?php

namespace Crontab;

function getLines () {
    exec('crontab -l', $lines, $code);
    if ($code !== 0 && $code !== 1) return false;
    return $lines;
}
