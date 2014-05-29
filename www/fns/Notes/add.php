<?php

namespace Notes;

function add ($mysqli, $id_users, $text, $tags, $encrypt) {

    $text = $mysqli->real_escape_string($text);
    $tags = $mysqli->real_escape_string($tags);
    $encrypt = $encrypt ? '1' : '0';
    $insert_time = $update_time = time();

    $sql = 'insert into notes'
        .' (id_users, text, tags, encrypt,'
        .' insert_time, update_time)'
        ." values ($id_users, '$text', '$tags', $encrypt,"
        ." $insert_time, $update_time)";

    $mysqli->query($sql) || trigger_error($mysqli->error);

    return $mysqli->insert_id;

}
