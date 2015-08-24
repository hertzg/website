<?php

namespace Password;

function hash ($password) {
    $sha512_key = openssl_random_pseudo_bytes(64);
    $hash = hash_init('sha512', HASH_HMAC, $sha512_key);
    hash_update($hash, $password);
    $sha512_hash = hash_final($hash, true);
    return [$sha512_hash, $sha512_key];
}
