<?php

namespace InfoEmail;

function isValid ($infoEmail) {
    $regex = "/^[a-z0-9][a-z0-9._-]*@[a-z0-9][a-z0-9.-]*$/";
    return preg_match($regex, $infoEmail);
}
