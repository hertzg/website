<?php

namespace Invitations;

function add ($mysqli, $note, $insertApiKey) {

    include_once __DIR__.'/../LinkKey/random.php';
    $key = \LinkKey\random();

    $note = $mysqli->real_escape_string($note);
    $key = $mysqli->real_escape_string($key);
    $insert_time = $update_time = time();
    if ($insertApiKey === null) {
        $insert_api_key_id = $insert_api_key_name = 'null';
    } else {

        $insert_api_key_id = $insertApiKey->id;

        $name = $insertApiKey->name;
        $insert_api_key_name = "'".$mysqli->real_escape_string($name)."'";

    }

    $sql = 'insert into invitations'
        .' (note, `key`, insert_time, update_time,'
        .' insert_api_key_id, insert_api_key_name)'
        ." values ('$note', '$key', $insert_time, $update_time,"
        ." $insert_api_key_id, $insert_api_key_name)";
    $mysqli->query($sql) || trigger_error($mysqli->error);

    return $mysqli->insert_id;

}
