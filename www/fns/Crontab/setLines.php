<?php

namespace Crontab;

function setLines ($lines) {
    $lines = escapeshellarg(join("\n", $lines));
    exec("echo $lines | crontab -", $output_lines, $code);
    return $code === 0;
}
