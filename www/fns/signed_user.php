<?php

function signed_user () {

    include_once __DIR__.'/session_start_custom.php';
    session_start_custom();

    $user = null;

    if (!array_key_exists('user', $_SESSION)) {

        include_once __DIR__.'/get_mysqli.php';
        $mysqli = get_mysqli();

        include_once __DIR__.'/request_valid_token.php';
        $token = request_valid_token($mysqli);

        if ($token) {

            include_once __DIR__.'/Users/get.php';
            $user = Users\get($mysqli, $token->id_users);

            if ($user) {
                $_SESSION['user'] = $user;
                $_SESSION['token'] = $token;
            }

        }

    }

    if (array_key_exists('user', $_SESSION)) {

        include_once __DIR__.'/get_mysqli.php';
        $mysqli = get_mysqli();

        include_once __DIR__.'/Users/get.php';
        $user = Users\get($mysqli, $_SESSION['user']->id_users);

        if ($user) {
            $expires = time() + 60 * 60 * 24 * 30;
            setcookie('username', $user->username, $expires, '/');
            if (array_key_exists('token', $_SESSION)) {

                $token = $_SESSION['token'];
                setcookie('token', bin2hex($token->token_text), $expires, '/');

                include_once __DIR__.'/Tokens/updateAccessTime.php';
                Tokens\updateAccessTime($mysqli, $token->id);

            }
        }

    }

    return $user;

}
