<?php

namespace Password;

function hash ($password) {
    $salt = openssl_random_pseudo_bytes(32);
    $hash = md5($password.$salt, true);
    return array($hash, $salt);
}
