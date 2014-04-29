<?php

namespace Schedules;

function add ($mysqli, $id_users, $text) {
    $text = $mysqli->real_escape_string($text);
    $sql = 'insert into schedules (id_users, text)'
        ." values ($id_users, '$text')";
    $mysqli->query($sql) || trigger_error($mysqli->error);
    return $mysqli->insert_id;
}
