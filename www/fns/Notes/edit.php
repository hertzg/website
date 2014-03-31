<?php

namespace Notes;

function edit ($mysqli, $id_users, $id, $note_text, $tags) {
    $note_text = $mysqli->real_escape_string($note_text);
    $tags = $mysqli->real_escape_string($tags);
    $update_time = time();
    $sql = 'update notes set'
        ." note_text = '$note_text',"
        ." tags = '$tags',"
        ." update_time = $update_time"
        ." where id_users = $id_users and id_notes = $id";
    $mysqli->query($sql);
}
