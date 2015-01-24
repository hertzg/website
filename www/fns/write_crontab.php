<?php

function write_crontab () {

    exec('crontab -l', $existing_lines, $code);
    if ($code !== 0 && $code !== 1) return false;

    include_once __DIR__.'/get_crontab_lines.php';
    $lines = get_crontab_lines();

    foreach ($lines as $line) {
        if (!in_array($line, $existing_lines)) $existing_lines[] = $line;
    }

    $lines = escapeshellarg(join("\n", $existing_lines));
    exec("echo $lines | crontab -", $output_lines, $code);
    if ($code !== 0) return false;
    return true;

}
