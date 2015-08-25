<?php

namespace EncryptionKey;

function random ($password, &$encryption_key, &$encryption_key_iv) {

    include_once __DIR__.'/length.php';
    $key = openssl_random_pseudo_bytes(length());

    include_once __DIR__.'/../Crypto/encrypt.php';
    \Crypto\encrypt($password, $key, $encryption_key, $encryption_key_iv);

}
