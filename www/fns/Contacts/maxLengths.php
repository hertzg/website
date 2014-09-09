<?php

namespace Contacts;

function maxLengths () {
    include_once __DIR__.'/../Email/maxLength.php';
    include_once __DIR__.'/../FullName/maxLength.php';
    include_once __DIR__.'/../Tags/maxLength.php';
    include_once __DIR__.'/../Username/maxLength.php';
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
