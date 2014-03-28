<?php

namespace Username;

function isLong ($username) {
    $length = mb_strlen($username, 'UTF-8');
    include_once __DIR__.'/maxLength.php';
    return $length > maxLength();
}
