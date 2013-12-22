<?php

function str_collapse_spaces_multiline ($str) {
    $lines = str_split_lines($str);
    foreach ($lines as &$line) {
        $line = str_collapse_spaces($line);
    }
    return join("\n", $lines);
}

include_once 'str_collapse_spaces.php';
include_once 'str_split_lines.php';
