<?php

namespace TokenAuths;

function add ($mysqli, $id_tokens, $id_users, $remote_address, $user_agent) {

    $remote_address = $mysqli->real_escape_string($remote_address);
    if ($user_agent === null) $user_agent = 'null';
    else $user_agent = "'".$mysqli->real_escape_string($user_agent)."'";
    $insert_time = time();

    $sql = 'insert into token_auths (id_tokens, id_users,'
        .' remote_address, user_agent, insert_time)'
        ." values ($id_tokens, $id_users,"
        ." '$remote_address', $user_agent, $insert_time)";

    $mysqli->query($sql) || trigger_error($mysqli->error);

}
