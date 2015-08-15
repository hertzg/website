<?php

namespace LinkKey;

function random () {
    include_once __DIR__.'/length.php';
    return openssl_random_pseudo_bytes(length());
}
