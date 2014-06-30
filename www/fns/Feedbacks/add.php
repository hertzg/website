<?php

namespace Feedbacks;

function add ($mysqli, $id_users, $text) {

    if ($id_users === null) $id_users = 'null';
    $text = $mysqli->real_escape_string($text);
    $insert_time = time();

    $sql = 'insert into feedbacks'
        .' (id_users, text, insert_time)'
        ." values ($id_users, '$text', $insert_time)";
    $mysqli->query($sql) || trigger_error($mysqli->error);
    return $mysqli->insert_id;

}
