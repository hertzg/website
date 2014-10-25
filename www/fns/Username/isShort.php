<?php

namespace Username;

function isShort ($username) {
    include_once __DIR__.'/minLength.php';
    return mb_strlen($username, 'UTF-8') < minLength();
}
