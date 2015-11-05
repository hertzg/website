<?php

namespace Crontab;

function removeLines ($remove_lines) {

    exec('crontab -l', $existing_lines, $code);
    if ($code !== 0 && $code !== 1) return false;

    $filter = function ($existing_line) use ($remove_lines) {
        return !in_array($existing_line, $remove_lines);
    };
    $existing_lines = array_filter($existing_lines, $filter);

    $lines = escapeshellarg(join("\n", $existing_lines));
    exec("echo $lines | crontab -", $output_lines, $code);
    if ($code !== 0) return false;

    return true;

}
