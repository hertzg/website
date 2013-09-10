<?php

if (!function_exists('hex2bin')) {
    function hex2bin ($input) {
        $chunks = str_split($input, 2);
        $result = '';
        foreach ($chunks as $chunk) {
            $result .= chr(hexdec($chunk));
        }
        return $result;
    }
}
