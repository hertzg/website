<?php

namespace Users;

function maxLengths () {
    $fnsDir = __DIR__.'/..';
    include_once "$fnsDir/Email/maxLength.php";
    include_once "$fnsDir/FullName/maxLength.php";
    include_once "$fnsDir/Username/maxLength.php";
    return [
        'email' => \Email\maxLength(),
        'full_name' => \FullName\maxLength(),
        'reset_password_key' => 16,
        'username' => \Username\maxLength(),
        'verify_email_key' => 16,
    ];
}
