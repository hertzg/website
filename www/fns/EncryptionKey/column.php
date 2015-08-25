<?php

namespace EncryptionKey;

function column () {
    include_once __DIR__.'/length.php';
    include_once __DIR__.'/../Crypto/encryptedLength.php';
    return [
        'type' => 'binary('.\Crypto\encryptedLength(length()).')',
        'nullable' => true,
    ];
}
