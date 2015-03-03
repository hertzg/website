<?php

namespace Events;

function addDeleted ($mysqli, $id, $id_users, $text,
    $event_time, $insert_time, $update_time, $revision) {

    $text = $mysqli->real_escape_string($text);

    $sql = 'insert into events'
        .' (id, id_users, text, event_time,'
        .' insert_time, update_time, revision)'
        ." values ($id, $id_users, '$text', $event_time,"
        ." $insert_time, $update_time, $revision)";

    $mysqli->query($sql) || trigger_error($mysqli->error);

}
