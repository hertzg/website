<?php

namespace Tasks;

function add ($mysqli, $id_users, $text, $top_priority, $tags) {
    $text = $mysqli->real_escape_string($text);
    $top_priority = $top_priority ? '1' : '0';
    $tags = $mysqli->real_escape_string($tags);
    $insert_time = $update_time = time();
    $sql = 'insert into tasks'
        .' (id_users, text, top_priority,'
        .' tags, insert_time, update_time)'
        ." values ($id_users, '$text', $top_priority,"
        ." '$tags', $insert_time, $update_time)";
    $mysqli->query($sql);
    return $mysqli->insert_id;
}
