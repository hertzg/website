<?php

namespace Session\EncryptionKey;

function get () {
    if (array_key_exists('encryption_key', $_SESSION)) {
        $object = $_SESSION['encryption_key'];
        if ($object['insert_time'] < time() - 10 * 60) {
            unset($_SESSION['encryption_key']);
            return;
        }
        return $object['key'];
    }
}
