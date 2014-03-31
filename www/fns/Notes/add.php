<?php

namespace Notes;

function add ($mysqli, $id_users, $note_text, $tags) {
    $note_text = $mysqli->real_escape_string($note_text);
    $tags = $mysqli->real_escape_string($tags);
    $insert_time = $update_time = time();
    $sql = 'insert into notes'
        .' (id_users, note_text, tags,'
        .' insert_time, update_time)'
        ." values ($id_users, '$note_text', '$tags',"
        ." $insert_time, $update_time)";
    $mysqli->query($sql);
    return $mysqli->insert_id;
}
