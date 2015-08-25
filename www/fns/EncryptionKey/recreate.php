<?php

namespace EncryptionKey;

function recreate ($currentPassword, $newPassword,
    &$encryption_key, &$encryption_key_iv) {

    $fnsDir = __DIR__.'/..';

    include_once "$fnsDir/Crypto/decrypt.php";
    $key = \Crypto\decrypt($currentPassword,
        $encryption_key, $encryption_key_iv);

    include_once "$fnsDir/Crypto/encrypt.php";
    \Crypto\encrypt($newPassword, $key, $encryption_key, $encryption_key_iv);

}
