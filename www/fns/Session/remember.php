<?php

namespace Session;

function remember ($mysqli, $user) {

    $token_text = md5(uniqid(), true);

    $key = 'HTTP_USER_AGENT';
    if (array_key_exists($key, $_SERVER)) $user_agent = $_SERVER[$key];
    else $user_agent = null;

    $fnsDir = __DIR__.'/..';

    include_once "$fnsDir/Users/Tokens/add.php";
    $id = \Users\Tokens\add($mysqli, $user->id_users,
        $user->username, $token_text, $user_agent);

    include_once "$fnsDir/Tokens/get.php";
    $token = \Tokens\get($mysqli, $id);

    if ($token) {
        include_once "$fnsDir/Cookie/set.php";
        \Cookie\set('token', bin2hex($token_text));
        $_SESSION['token'] = $token;
    }

}
