<?php

function require_admin () {

    $invalid = function () {
        include_once __DIR__.'/../../fns/ErrorPage/unauthorized.php';
        ErrorPage\unauthorized('Basic realm="Zvini Admin"');
    };

    if (!array_key_exists('PHP_AUTH_USER', $_SERVER)) $invalid();

    $fnsDir = __DIR__.'/../../fns';

    include_once "$fnsDir/Admin/get.php";
    Admin\get($username, $hash, $salt, $sha512_hash, $sha512_key);

    if ($username !== $_SERVER['PHP_AUTH_USER']) $invalid();

    $password = $_SERVER['PHP_AUTH_PW'];

    include_once "$fnsDir/Password/match.php";
    $match = Password\match($hash, $salt,
        $sha512_hash, $sha512_key, $password);

    if (!$match) $invalid();

    if ($hash !== null) {

        include_once "$fnsDir/Password/hash.php";
        list($sha512_hash, $sha512_key) = Password\hash($password);

        include_once "$fnsDir/Admin/set.php";
        Admin\set($username, $sha512_hash, $sha512_key);

    }

    include_once "$fnsDir/session_start_custom.php";
    session_start_custom($new);

}
