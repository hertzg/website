<?php

namespace Contacts;

function maxLengths () {
    $fnsDir = __DIR__.'/..';
    include_once "$fnsDir/Email/maxLength.php";
    include_once "$fnsDir/FullName/maxLength.php";
    include_once "$fnsDir/Tags/maxLength.php";
    include_once "$fnsDir/Username/maxLength.php";
    return [
        'address' => 128,
        'alias' => 32,
        'email' => \Email\maxLength(),
        'full_name' => \FullName\maxLength(),
        'phone1' => 32,
        'phone2' => 32,
        'tags' => \Tags\maxLength(),
        'username' => \Username\maxLength(),
    ];
}
