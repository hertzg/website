<?php

namespace Session;

function remember ($mysqli, $user) {

    $fnsDir = __DIR__.'/..';

    include_once "$fnsDir/Tokens/maxLengths.php";
    $maxLengths = \Tokens\maxLengths();

    $token_text = openssl_random_pseudo_bytes($maxLengths['token_text']);

    $key = 'HTTP_USER_AGENT';
    if (array_key_exists($key, $_SERVER)) $user_agent = $_SERVER[$key];
    else $user_agent = null;

    include_once "$fnsDir/ClientAddress/get.php";
    include_once "$fnsDir/Users/Tokens/add.php";
    $id = \Users\Tokens\add($mysqli, $user->id_users,
        $user->username, $token_text, \ClientAddress\get(), $user_agent);

    include_once "$fnsDir/Tokens/get.php";
    $token = \Tokens\get($mysqli, $id);

    if ($token) {
        include_once "$fnsDir/Cookie/set.php";
        \Cookie\set('token', bin2hex($token_text));
        $_SESSION['token'] = $token;
    }

}
