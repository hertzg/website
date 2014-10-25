<?php

namespace Email;

function isValid ($email) {

    $regex = "/^[a-z0-9][a-z0-9._-]*@[a-z0-9][a-z0-9.-]*[a-z0-9]\.[a-z.]+$/";
    if (!preg_match($regex, $email)) return false;

    include_once __DIR__.'/maxLength.php';
    return strlen($email) <= maxLength();

}
