<?php

function is_md5 ($string, $raw_output = false) {
    if ($raw_output) {
        return strlen($string) == 16;
    }
    return preg_match('/^[0-9a-f]{32}$/', $string);
}
