<?php

namespace Password;

function match ($hash, $salt, $sha512_hash, $sha512_key, $password) {
    if ($sha512_hash !== null) {
        return $sha512_hash === hash_hmac('sha512',
            $password, $sha512_key, true);
    }
    return $hash === md5($password.$salt, true);
}
