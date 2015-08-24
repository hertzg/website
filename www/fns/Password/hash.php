<?php

namespace Password;

function hash ($password) {

    $sha512_key = openssl_random_pseudo_bytes(64);
    $hh = hash_init('sha512', HASH_HMAC, $sha512_key);
    hash_update($hh, $password);
    $sha512_hash = hash_final($hh, true);

    $salt = openssl_random_pseudo_bytes(32);
    $hash = md5($password.$salt, true);
    return [$hash, $salt, $sha512_hash, $sha512_key];

}
