<?php

namespace Session\EncryptionKey;

function get () {
    include_once __DIR__.'/present.php';
    if (present()) return $_SESSION['encryption_key'];
}
