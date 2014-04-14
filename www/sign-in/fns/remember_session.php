<?php

function remember_session ($mysqli, $user) {

    $token_text = md5(uniqid(), true);

    $key = 'HTTP_USER_AGENT';
    if (array_key_exists($key, $_SERVER)) {
        $user_agent = $_SERVER[$key];
    } else {
        $user_agent = null;
    }

    $id_users = $user->id_users;

    include_once __DIR__.'/../../fns/Tokens/add.php';
    $id = Tokens\add($mysqli, $id_users, $user->username,
        $token_text, $user_agent);

    include_once __DIR__.'/../../fns/Tokens/get.php';
    $token = Tokens\get($mysqli, $id);

    if ($token) {
        $expires = time() + 60 * 60 * 24 * 30;
        setcookie('token', bin2hex($token_text), $expires, '/');
        $_SESSION['token'] = $token;
    }

}
