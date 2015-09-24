<?php

namespace ApiKey;

function random () {

    include_once __DIR__.'/length.php';
    $length = length();

    $key = openssl_random_pseudo_bytes($length);

    include_once __DIR__.'/../base62_encode.php';
    return substr(base62_encode($key), 0, $length);

}
