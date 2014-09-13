<?php

include_once '../../fns/require_same_domain_referer.php';
require_same_domain_referer('./');

include_once '../../fns/require_user.php';
$user = require_user('../../');

include_once '../../fns/require_valid_token.php';
include_once '../../lib/mysqli.php';
$token = require_valid_token($mysqli);

if (!$token) {

    $token_text = md5(uniqid(), true);

    $key = 'HTTP_USER_AGENT';
    if (array_key_exists($key, $_SERVER)) $user_agent = $_SERVER[$key];
    else $user_agent = null;

    include_once '../../fns/Users/Tokens/add.php';
    $id = Users\Tokens\add($mysqli, $user->id_users,
        $user->username, $token_text, $user_agent);

    include_once '../../fns/Tokens/get.php';
    $token = Tokens\get($mysqli, $id);

    if ($token) {
        $expires = time() + 60 * 60 * 24 * 30;
        setcookie('token', bin2hex($token_text), $expires, '/');
        $_SESSION['token'] = $token;
    }

}

unset($_SESSION['account/tokens/errors']);
$_SESSION['account/tokens/messages'] = ['Current session has been remembered.'];

include_once '../../fns/redirect.php';
redirect();
