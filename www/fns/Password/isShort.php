<?php

namespace Password;

function isShort ($password) {
    include_once __DIR__.'/minLength.php';
    return mb_strlen($password, 'UTF-8') < minLength();
}
