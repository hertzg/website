<?php

namespace ApiKey;

function random () {

    include_once __DIR__.'/length.php';
    $length = length();

    $charset = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charset_length = strlen($charset);

    $key = '';
    $key_length = 0;

    $bytes_length = $length * 2;

    while ($key_length < $length) {
        $bytes = unpack('C*', openssl_random_pseudo_bytes($bytes_length));
        foreach ($bytes as $byte) {
            if ($byte > $charset_length - 1) continue;
            $key .= $charset[$byte];
            $key_length++;
            if ($key_length === $length) break;
        }
    }

    return $key;

}
