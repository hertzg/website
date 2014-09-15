<?php

namespace Users;

function getByUsernameAndPassword ($mysqli, $username, $password) {
    include_once __DIR__.'/getByUsername.php';
    $user = getByUsername($mysqli, $username);
    if ($user) {
        include_once __DIR__.'/../Password/match.php';
        $hash = $user->password_hash;
        $salt = $user->password_salt;
        if (\Password\match($hash, $salt, $password)) return $user;
    }
}
