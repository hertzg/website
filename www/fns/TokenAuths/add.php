<?php

namespace TokenAuths;

function add ($mysqli, $id_tokens, $id_users, $remote_address) {

    $remote_address = $mysqli->real_escape_string($remote_address);
    $insert_time = time();

    $sql = 'insert into token_auths'
        .' (id_tokens, id_users, remote_address, insert_time)'
        ." values ($id_tokens, $id_users, '$remote_address', $insert_time)";

    $mysqli->query($sql) || trigger_error($mysqli->error);

}
