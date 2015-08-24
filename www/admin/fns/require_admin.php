<?php

function require_admin () {

    $invalid = function () {
        header('HTTP/1.0 401 Unauthorized');
        header('WWW-Authenticate: Basic realm="Zvini Admin"');
        exit;
    };

    if (!array_key_exists('PHP_AUTH_USER', $_SERVER)) $invalid();

    $fnsDir = __DIR__.'/../../fns';

    include_once "$fnsDir/Admin/get.php";
    Admin\get($username, $hash, $salt, $sha512_hash, $sha512_key);

    if ($username !== $_SERVER['PHP_AUTH_USER']) $invalid();

    include_once "$fnsDir/Password/match.php";
    $match = Password\match($hash, $salt,
        $sha512_hash, $sha512_key, $_SERVER['PHP_AUTH_PW']);

    if (!$match) $invalid();

    include_once "$fnsDir/session_start_custom.php";
    session_start_custom($new);

}
