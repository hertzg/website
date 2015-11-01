<?php

namespace ApiKey;

function isValid ($key) {
    include_once __DIR__.'/length.php';
    return preg_match('/^[0-9a-zA-Z]{'.length().'}$/', $key);
}
