<?php

function text_title ($text, $length) {
    include_once __DIR__.'/str_split_lines.php';
    $lines = str_split_lines($text);
    if ($lines) return substr($lines[0], 0, $length);
    return '';
}
