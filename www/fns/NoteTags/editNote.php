<?php

namespace NoteTags;

function editNote ($mysqli, $id_notes, $text,
    $tags, $encrypt, $insert_time, $update_time) {

    $text = $mysqli->real_escape_string($text);
    $tags = $mysqli->real_escape_string($tags);
    $encrypt = $encrypt ? '1' : '0';

    $sql = "update note_tags set text = '$text', tags = '$tags',"
        ." encrypt = $encrypt, insert_time = $insert_time,"
        ." update_time = $update_time where id_notes = $id_notes";

    $mysqli->query($sql) || trigger_error($mysqli->error);

}
