<?php

namespace Crypto;

function encrypt ($password, $data, &$encrypted_data, &$iv) {
    $iv = mt_rand(10000000, 99999999);
    $encrypted_data = openssl_encrypt($data,
        'des-cbc', $password, OPENSSL_RAW_DATA, $iv);
}
