<?php

namespace Session;

function authenticate ($mysqli, $username,
    $password, $remember, &$disabled, &$rate_limited) {

    $fnsDir = __DIR__.'/..';

    include_once "$fnsDir/get_client_address.php";
    $client_address = get_client_address();

    include_once "$fnsDir/InvalidSignins/countRecent.php";
    $numInvalidSignins = \InvalidSignins\countRecent($mysqli, $client_address);

    include_once "$fnsDir/AuthRateLimit/number.php";
    if ($numInvalidSignins > \AuthRateLimit\number()) {
        $rate_limited = true;
        return;
    }

    include_once "$fnsDir/Users/getByUsernameAndPassword.php";
    $user = \Users\getByUsernameAndPassword($mysqli, $username, $password);

    if ($user) {

        if ($user->disabled) {
            $disabled = true;
            $user = null;
            return;
        }

        $_SESSION['user'] = $user;
        $id_users = $user->id_users;

        include_once "$fnsDir/Users/signIn.php";
        \Users\signIn($mysqli, $id_users, $client_address);

        include_once "$fnsDir/Signins/add.php";
        include_once "$fnsDir/UserAgent/get.php";
        \Signins\add($mysqli, $id_users, $client_address, \UserAgent\get());

        if ($remember) {
            include_once __DIR__.'/remember.php';
            remember($mysqli, $user);
        }

        if ($user->encryption_key === null) {

            include_once "$fnsDir/EncryptionKey/random.php";
            \EncryptionKey\random($password, $random_key,
                $encryption_key, $encryption_key_iv);

            include_once "$fnsDir/Users/editEncryptionKey.php";
            \Users\editEncryptionKey($mysqli, $id_users,
                $encryption_key, $encryption_key_iv);

            $encryption_key = $random_key;

        } else {
            include_once "$fnsDir/Crypto/decrypt.php";
            $encryption_key = \Crypto\decrypt($password,
                $user->encryption_key, $user->encryption_key_iv);
        }

        include_once __DIR__.'/EncryptionKey/set.php';
        EncryptionKey\set($encryption_key);

    } else {
        include_once "$fnsDir/InvalidSignins/add.php";
        \InvalidSignins\add($mysqli, $username, $client_address);
    }

    return $user;

}
