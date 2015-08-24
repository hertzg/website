<?php

namespace Password;

function match ($hash, $salt, $sha512_hash, $sha512_key, $password) {
    if ($sha512_hash !== null) {
        $hh = hash_init('sha512', HASH_HMAC, $sha512_key);
        hash_update($hh, $password);
        return $sha512_hash === hash_final($hh, true);
    }
    return $hash === md5($password.$salt, true);
}
