<?php

namespace Session;

function invalidate ($mysqli) {

    $fnsDir = __DIR__.'/..';

    if (array_key_exists('token', $_SESSION)) {

        $token = $_SESSION['token'];

        include_once "$fnsDir/Tokens/get.php";
        $token = \Tokens\get($mysqli, $token->id);

        if ($token) {
            include_once "$fnsDir/Users/Tokens/delete.php";
            \Users\Tokens\delete($mysqli, $token);
        }

        include_once "$fnsDir/Cookie/remove.php";
        \Cookie\remove('token');

    }

    session_destroy();

    include_once "$fnsDir/session_start_custom.php";
    session_start_custom($new);

}
