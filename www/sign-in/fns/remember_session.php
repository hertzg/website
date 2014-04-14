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

    include_once '../fns/Tokens/add.php';
    $id = Tokens\add($mysqli, $id_users, $user->username,
        $token_text, $user_agent);

    include_once '../fns/Tokens/get.php';
    $token = Tokens\get($mysqli, $id);

    if ($token) {
        setcookie('token', bin2hex($token_text), time() + 60 * 60 * 24 * 30, '/');
        $_SESSION['token'] = $token;
    }

}
