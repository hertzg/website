<?php

namespace Invitations;

function add ($mysqli, $note) {

    include_once __DIR__.'/../LinkKey/random.php';
    $key = \LinkKey\random();

    $note = $mysqli->real_escape_string($note);
    $key = $mysqli->real_escape_string($key);
    $insert_time = $update_time = time();

    $sql = 'insert into invitations (note, `key`, insert_time, update_time)'
        ." values ('$note', '$key', $insert_time, $update_time)";
    $mysqli->query($sql) || trigger_error($mysqli->error);

    return $mysqli->insert_id;

}
