<?php

namespace Contacts;

function maxLengths () {
    include_once __DIR__.'/../Username/maxLength.php';
    return [
        'full_name' => 32,
        'alias' => 32,
        'address' => 128,
        'email' => 32,
        'phone1' => 32,
        'phone2' => 32,
        'username' => \Username\maxLength(),
        'tags' => 256,
    ];
}
