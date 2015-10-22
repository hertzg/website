<?php

namespace Users\Account\Close;

function deleteTokens ($mysqli, $user) {

    if (!$user->num_tokens) return;

    $id_users = $user->id_users;
    $fnsDir = __DIR__.'/../../..';

    include_once "$fnsDir/Tokens/deleteOnUser.php";
    \Tokens\deleteOnUser($mysqli, $id_users);

    include_once "$fnsDir/TokenAuths/deleteOnUser.php";
    \TokenAuths\deleteOnUser($mysqli, $id_users);

}
