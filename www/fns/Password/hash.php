<?php

namespace Password;

function hash ($password) {
    $sha512_key = openssl_random_pseudo_bytes(64);
    $sha512_hash = hash_hmac('sha512', $password, $sha512_key, true);
    return [$sha512_hash, $sha512_key];
}
