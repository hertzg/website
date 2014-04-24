<?php

function str_collapse_spaces_multiline ($str) {

    include_once __DIR__.'/str_split_lines.php';
    $lines = str_split_lines($str);

    if ($lines) {
        include_once __DIR__.'/str_collapse_spaces.php';
        foreach ($lines as &$line) {
            $line = str_collapse_spaces($line);
        }
    }

    return join("\n", $lines);

}
