<?php

function str_split_lines ($string, $limit = -1) {
    $lines = preg_split("/\r\n|\r|\n/", $string, $limit);
    if (count($lines) == 1 && $lines[0] === '' && $limit != 2) return [];
    return $lines;
}
