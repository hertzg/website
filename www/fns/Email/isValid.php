<?php

namespace Email;

function isValid ($email) {
    $regex = "/^[a-z0-9][a-z0-9._-]*@[a-z0-9][a-z0-9.-]*[a-z0-9]\.[a-z.]+$/";
    return preg_match($regex, $email);
}
