<?php

namespace Session\EncryptionKey;

function present () {
    return array_key_exists('encryption_key', $_SESSION);
}
