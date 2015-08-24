<?php

namespace Users;

function getByUsernameAndPassword ($mysqli, $username, $password) {
    include_once __DIR__.'/getByUsername.php';
    $user = getByUsername($mysqli, $username);
    if ($user) {

        include_once __DIR__.'/../Password/match.php';
        $match = \Password\match($user->password_hash,
            $user->password_salt, $user->password_sha512_hash,
            $user->password_sha512_key, $password);

        if ($match) return $user;

    }
}
