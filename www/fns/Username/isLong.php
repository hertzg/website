<?php

namespace Username;

function isLong ($username) {
    include_once __DIR__.'/maxLength.php';
    return mb_strlen($username, 'UTF-8') > maxLength();
}
