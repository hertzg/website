<?php

namespace Username;

function isShort ($username) {
    $length = mb_strlen($username, 'UTF-8');
    include_once __DIR__.'/minLength.php';
    return $length < minLength();
}
