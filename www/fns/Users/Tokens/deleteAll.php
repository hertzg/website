<?php

namespace Users\Tokens;

function deleteAll ($mysqli, $id_users) {

    include_once __DIR__.'/../../Tokens/deleteOnUser.php';
    \Tokens\deleteOnUser($mysqli, $id_users);

    include_once __DIR__.'/../../TokenAuths/deleteOnUser.php';
    \TokenAuths\deleteOnUser($mysqli, $id_users);

    $sql = "update users set num_tokens = 0 where id_users = $id_users";
    $mysqli->query($sql) || trigger_error($mysqli->error);

}
