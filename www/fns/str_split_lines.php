<?php

function str_split_lines ($string) {
    $lines = preg_split("/\r\n|\r|\n/", $string);
    if (count($lines) == 1 && !$lines[0]) {
        return [];
    }
    return $lines;
}
