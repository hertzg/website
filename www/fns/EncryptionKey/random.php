<?php

namespace EncryptionKey;

function random ($password, &$random_key,
    &$encryption_key, &$encryption_key_iv) {

    include_once __DIR__.'/length.php';
    $random_key = openssl_random_pseudo_bytes(length());

    include_once __DIR__.'/../Crypto/encrypt.php';
    \Crypto\encrypt($password, $random_key,
        $encryption_key, $encryption_key_iv);

}
