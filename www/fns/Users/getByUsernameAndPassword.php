<?php

namespace Users;

function getByUsernameAndPassword ($mysqli, $username, $password) {

    include_once __DIR__.'/getByUsername.php';
    $user = getByUsername($mysqli, $username);
    if ($user) {
        include_once __DIR__.'/../Password/match.php';
        if (\Password\match($user->password_hash, $password)) {
            return $user;
        }
    }

}
