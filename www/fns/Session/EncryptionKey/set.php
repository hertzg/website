<?php

namespace Session\EncryptionKey;

function set ($encryption_key) {
    $_SESSION['encryption_key'] = $key;
}
