<?php

namespace Tasks;

function add ($mysqli, $id_users, $text, $tags) {
    $text = $mysqli->real_escape_string($text);
    $tags = $mysqli->real_escape_string($tags);
    $insert_time = $update_time = time();
    $sql = 'insert into tasks'
        .' (id_users, text, tags, insert_time, update_time)'
        ." values ($id_users, '$text', '$tags', $insert_time, $update_time)";
    $mysqli->query($sql);
    return $mysqli->insert_id;
}
