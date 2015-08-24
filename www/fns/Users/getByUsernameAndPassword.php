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

        if ($match) {

            if ($user->password_hash !== null) {

                include_once __DIR__.'/../Password/hash.php';
                list($sha512_hash, $sha512_key) = Password\hash($password);

                include_once __DIR__.'/editPassword.php';
                editPassword($mysqli, $user->id_users, $password);

            }

            return $user;

        }

    }
}
