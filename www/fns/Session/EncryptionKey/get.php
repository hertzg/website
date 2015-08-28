<?php

namespace Session\EncryptionKey;

function get () {
    if (array_key_exists('encryption_key', $_SESSION)) {
        return $_SESSION['encryption_key'];
    }
}
