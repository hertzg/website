<?php

namespace Tokens;

function maxLengths () {
    include_once __DIR__.'/../Username/maxLength.php';
    return [
        'username' => \Username\maxLength(),
        'token_text' => 16,
    ];
}
