<?php

namespace Users;

function maxLengths () {
    $fnsDir = __DIR__.'/..';
    include_once "$fnsDir/Email/maxLength.php";
    include_once "$fnsDir/FullName/maxLength.php";
    include_once "$fnsDir/Username/maxLength.php";
    return [
        'username' => \Username\maxLength(),
        'email' => \Email\maxLength(),
        'full_name' => \FullName\maxLength(),
    ];
}
