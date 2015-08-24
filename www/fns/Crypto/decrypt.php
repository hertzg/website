<?php

namespace Crypto;

function decrypt ($password, $encrypted_data, $iv) {
    return openssl_decrypt($encrypted_data,
        'des-cbc', $password, OPENSSL_RAW_DATA, $iv);
}
