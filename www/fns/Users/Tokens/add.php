<?php

namespace Users\Tokens;

function add ($mysqli, $id_users, $username,
    $token_text, $remote_address, $user_agent) {

    $fnsDir = __DIR__.'/../..';

    include_once "$fnsDir/Tokens/add.php";
    $id = \Tokens\add($mysqli, $id_users, $username,
        $token_text, $remote_address, $user_agent);

    include_once "$fnsDir/TokenAuths/add.php";
    include_once "$fnsDir/UserAgent/get.php";
    \TokenAuths\add($mysqli, $id,
        $id_users, $remote_address, \UserAgent\get());

    include_once __DIR__.'/addNumber.php';
    addNumber($mysqli, $id_users, 1);

    return $id;

}
