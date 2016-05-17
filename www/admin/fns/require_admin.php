<?php

function require_admin () {

    $fnsDir = __DIR__.'/../../fns';

    $invalid = function () use ($fnsDir) {
        include_once "$fnsDir/ErrorPage/unauthorized.php";
        ErrorPage\unauthorized('Basic realm="Zvini Admin"');
    };

    include_once "$fnsDir/signed_user.php";
    $user = signed_user();

    if ($user && !$user->disabled && $user->admin) return $user;

    if (!array_key_exists('PHP_AUTH_USER', $_SERVER)) $invalid();

    $username = $_SERVER['PHP_AUTH_USER'];
    $password = $_SERVER['PHP_AUTH_PW'];

    include_once "$fnsDir/get_mysqli.php";
    $mysqli = get_mysqli();

    if (!$mysqli->connect_errno) {

        include_once "$fnsDir/Session/authenticate.php";
        $user = Session\authenticate($mysqli, $username,
            $password, false, $disabled, $rate_limited);

        if ($user) {
            if (!$user->disabled && $user->admin) return $user;
            include_once "$fnsDir/Session/invalidate.php";
            Session\invalidate();
        }

    }

    include_once "$fnsDir/Admin/get.php";
    Admin\get($admin_username, $hash, $salt, $sha512_hash, $sha512_key);

    if ($admin_username !== $username) $invalid();

    include_once "$fnsDir/Password/match.php";
    $match = Password\match($hash, $salt,
        $sha512_hash, $sha512_key, $password);

    if (!$match) $invalid();

    if ($hash !== null) {

        include_once "$fnsDir/Password/hash.php";
        list($sha512_hash, $sha512_key) = Password\hash($password);

        include_once "$fnsDir/Admin/set.php";
        Admin\set($admin_username, $sha512_hash, $sha512_key);

    }

}
