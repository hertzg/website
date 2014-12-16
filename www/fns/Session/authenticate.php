<?php

namespace Session;

function authenticate ($mysqli, $username, $password, $remember) {

    $fnsDir = __DIR__.'/..';

    include_once "$fnsDir/Users/getByUsernameAndPassword.php";
    $user = \Users\getByUsernameAndPassword($mysqli, $username, $password);

    if ($user) {

        $_SESSION['user'] = $user;
        $id_users = $user->id_users;

        include_once "$fnsDir/Users/login.php";
        \Users\login($mysqli, $id_users);

        if ($user->password_salt === '') {
            include_once "$fnsDir/Users/editPassword.php";
            \Users\editPassword($mysqli, $id_users, $password);
        }

        if ($remember) {
            include_once __DIR__.'/remember.php';
            remember($mysqli, $user);
        }

    } else {
        include_once "$fnsDir/get_client_address.php";
        include_once "$fnsDir/InvalidSignins/add.php";
        \InvalidSignins\add($mysqli, $username, get_client_address());
    }

    return $user;

}
