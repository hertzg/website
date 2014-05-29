<?php

namespace Notes;

function edit ($mysqli, $id_users, $id, $text, $tags, $encrypt) {

    $text = $mysqli->real_escape_string($text);
    $tags = $mysqli->real_escape_string($tags);
    $encrypt = $encrypt ? '1' : '0';
    $update_time = time();

    $sql = "update notes set text = '$text',"
        ." tags = '$tags', encrypt = $encrypt, update_time = $update_time,"
        ." num_edits = num_edits + 1 where id_users = $id_users"
        ." and id_notes = $id";

    $mysqli->query($sql) || trigger_error($mysqli->error);

}
