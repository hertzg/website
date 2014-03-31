<?php

namespace Users;

function maxLengths () {
    include_once __DIR__.'/../Email/maxLength.php';
    return [
        'email' => \Email\maxLength(),
        'full_name' => 64,
    ];
}
