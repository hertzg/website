<?php

function remember_session ($mysqli, $user) {

    $token_text = md5(uniqid(), true);
    if (array_key_exists('HTTP_USER_AGENT', $_SERVER)) {
        $user_agent = $_SERVER['HTTP_USER_AGENT'];
    } else {
        $user_agent = null;
    }

    $id_users = $user->id_users;

    include_once '../fns/Tokens/add.php';
    $id_tokens = Tokens\add($mysqli, $id_users, $user->username,
        $token_text, $user_agent);

    include_once '../fns/Users/addNumTokens.php';
    Users\addNumTokens($mysqli, $id_users, 1);

    include_once '../fns/Tokens/get.php';
    $token = Tokens\get($mysqli, $id_tokens);

    if ($token) {
        setcookie('token', bin2hex($token_text), time() + 60 * 60 * 24 * 30, '/');
        $_SESSION['token'] = $token;
    }

}
