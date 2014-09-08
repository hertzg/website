<?php

namespace Users;

function maxLengths () {
    include_once __DIR__.'/../Email/maxLength.php';
    include_once __DIR__.'/../Username/maxLength.php';
    return [
        'username' => \Username\maxLength(),
        'email' => \Email\maxLength(),
        'full_name' => 64,
    ];
}
