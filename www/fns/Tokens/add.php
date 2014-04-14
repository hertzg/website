<?php

namespace Tokens;

function add ($mysqli, $id_users, $username, $token_text, $user_agent) {

    $username = $mysqli->real_escape_string($username);
    $token_text = $mysqli->real_escape_string($token_text);
    $insert_time = $access_time = time();

    if ($user_agent === null) {
        $user_agent = 'null';
    } else {
        $user_agent = "'".$mysqli->real_escape_string($user_agent)."'";
    }

    $sql = 'insert into tokens (id_users, username, token_text, user_agent,'
        .' insert_time, access_time)'
        ." values ($id_users, '$username', '$token_text', $user_agent,"
        ." $insert_time, $access_time)";

    $mysqli->query($sql) || trigger_error();

    $id_tokens = $mysqli->insert_id;

    include_once __DIR__.'/../Users/addNumTokens.php';
    \Users\addNumTokens($mysqli, $id_users, 1);

    return $id_tokens;

}
