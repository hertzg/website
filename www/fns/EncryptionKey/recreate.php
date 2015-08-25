<?php

namespace EncryptionKey;

function recreate ($currentPassword, $newPassword,
    &$encryption_key, &$encryption_key_iv) {

    include_once __DIR__.'/../Crypto/decrypt.php';
    $key = \Crypto\decrypt($currentPassword,
        $encryption_key, $encryption_key_iv);

    include_once __DIR__.'/../Crypto/encrypt.php';
    \Crypto\encrypt($newPassword, $key, $encryption_key, $encryption_key_iv);

}
