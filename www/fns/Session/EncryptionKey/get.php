<?php

namespace Session\EncryptionKey;

function get () {
    if (session_id() === '') return;
    if (array_key_exists('encryption_key', $_SESSION)) {
        $object = $_SESSION['encryption_key'];
        include_once __DIR__.'/minutes.php';
        if ($object['insert_time'] < time() - minutes() * 60) {
            unset($_SESSION['encryption_key']);
            return;
        }
        return $object['key'];
    }
}
