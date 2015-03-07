<?php

namespace Tokens;

function add ($mysqli, $id_users, $username,
    $token_text, $access_remote_address, $user_agent) {

    $username = $mysqli->real_escape_string($username);
    $token_text = $mysqli->real_escape_string($token_text);
    $insert_time = $access_time = time();
    $access_remote_address = $mysqli->real_escape_string(
        $access_remote_address);

    if ($user_agent === null) $user_agent = 'null';
    else $user_agent = "'".$mysqli->real_escape_string($user_agent)."'";

    $sql = 'insert into tokens (id_users, username, token_text,'
        .' access_remote_address, user_agent, insert_time, access_time)'
        ." values ($id_users, '$username', '$token_text',"
        ." '$access_remote_address', $user_agent, $insert_time, $access_time)";

    $mysqli->query($sql) || trigger_error($mysqli->error);

    return $mysqli->insert_id;

}
