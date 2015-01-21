<?php

namespace Session;

function authenticate ($mysqli, $username, $password, $remember) {

    $fnsDir = __DIR__.'/..';

    include_once "$fnsDir/Users/getByUsernameAndPassword.php";
    $user = \Users\getByUsernameAndPassword($mysqli, $username, $password);

    include_once "$fnsDir/get_client_address.php";
    $client_address = get_client_address();

    if ($user) {

        $_SESSION['user'] = $user;
        $id_users = $user->id_users;

        include_once "$fnsDir/Users/login.php";
        \Users\login($mysqli, $id_users);

        include_once "$fnsDir/Signins/add.php";
        \Signins\add($mysqli, $id_users, $client_address);

        if ($user->password_salt === '') {
            include_once "$fnsDir/Users/editPassword.php";
            \Users\editPassword($mysqli, $id_users, $password);
        }

        if ($remember) {
            include_once __DIR__.'/remember.php';
            remember($mysqli, $user);
        }

    } else {
        include_once "$fnsDir/InvalidSignins/add.php";
        \InvalidSignins\add($mysqli, $username, $client_address);
    }

    return $user;

}
