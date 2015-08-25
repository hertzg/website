<?php

namespace EncryptionKey;

function column () {
    include_once __DIR__.'/length.php';
    return [
        'type' => 'binary('.(ceil((length() + 1) / 8) * 8).')',
        'nullable' => true,
    ];
}
