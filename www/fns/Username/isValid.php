<?php

namespace Username;

function isValid ($username) {

    include_once __DIR__.'/isShort.php';
    if (isShort($username)) return false;

    include_once __DIR__.'/isLong.php';
    if (isLong($username)) return false;

    include_once __DIR__.'/containsIllegalChars.php';
    if (containsIllegalChars($username)) return false;

    include_once __DIR__.'/containsOnlyDigits.php';
    if (containsOnlyDigits($username)) return false;

    return true;

}
