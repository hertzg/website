<?php

namespace Session;

function remember ($mysqli, $user) {

    $fnsDir = __DIR__.'/..';

    include_once "$fnsDir/Tokens/maxLengths.php";
    $maxLengths = \Tokens\maxLengths();

    $token_text = openssl_random_pseudo_bytes($maxLengths['token_text']);

    include_once "$fnsDir/get_client_address.php";
    include_once "$fnsDir/UserAgent/get.php";
    include_once "$fnsDir/Users/Tokens/add.php";
    $id = \Users\Tokens\add($mysqli, $user->id_users,
        $user->username, $token_text, get_client_address(), \UserAgent\get());

    include_once "$fnsDir/Tokens/get.php";
    $token = \Tokens\get($mysqli, $id);

    if ($token) {
        include_once "$fnsDir/Cookie/set.php";
        \Cookie\set('token', bin2hex($token_text));
        $_SESSION['token'] = $token;
    }

}
