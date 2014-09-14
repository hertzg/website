<?php

function remember_session ($mysqli, $user) {

    $token_text = md5(uniqid(), true);

    $key = 'HTTP_USER_AGENT';
    if (array_key_exists($key, $_SERVER)) $user_agent = $_SERVER[$key];
    else $user_agent = null;

    $fnsDir = __DIR__.'/../../fns';

    include_once "$fnsDir/Users/Tokens/add.php";
    $id = Users\Tokens\add($mysqli, $user->id_users,
        $user->username, $token_text, $user_agent);

    include_once "$fnsDir/Tokens/get.php";
    $token = Tokens\get($mysqli, $id);

    if ($token) {
        $expires = time() + 60 * 60 * 24 * 30;
        setcookie('token', bin2hex($token_text), $expires, '/');
        $_SESSION['token'] = $token;
    }

}
