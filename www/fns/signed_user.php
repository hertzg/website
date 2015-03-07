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

        $id_users = $_SESSION['user']->id_users;

        include_once __DIR__.'/get_mysqli.php';
        $mysqli = get_mysqli();

        include_once __DIR__.'/Users/get.php';
        $user = Users\get($mysqli, $id_users);

        if ($user) {

            include_once __DIR__.'/Cookie/set.php';
            Cookie\set('username', $user->username);

            $time = time();

            if (array_key_exists('token', $_SESSION)) {
                $token = $_SESSION['token'];
                $access_time = $token->access_time;
                if ($access_time === null || $access_time + 30 < $time) {

                    $value = bin2hex($token->token_text);
                    Cookie\set('token', $value);

                    include_once __DIR__.'/get_client_address.php';
                    include_once __DIR__.'/Tokens/editAccess.php';
                    Tokens\editAccess($mysqli, $token->id,
                        $time, get_client_address());

                    $token->access_time = $time;

                }
            }

            $access_time = $user->access_time;
            if ($access_time === null || $access_time + 30 < $time) {
                include_once __DIR__.'/get_client_address.php';
                include_once __DIR__.'/Users/editAccess.php';
                Users\editAccess($mysqli, $id_users,
                    $time, get_client_address());
            }

        }

    }

    return $user;

}
