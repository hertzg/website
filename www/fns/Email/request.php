<?php

namespace Email;

function request ($name = 'email') {

    $fnsDir = __DIR__.'/..';

    include_once "$fnsDir/request_strings.php";
    list($email) = request_strings($name);

    include_once "$fnsDir/str_collapse_spaces.php";
    $email = str_collapse_spaces($email);

    $email = mb_strtolower($email, 'UTF-8');

    include_once __DIR__.'/maxLength.php';
    return mb_substr($email, 0, maxLength(), 'UTF-8');

}
