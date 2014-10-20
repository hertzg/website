<?php

namespace Notes;

function edit ($mysqli, $id_users, $id, $text, $tags, $tag_names, $encrypt) {

    $text = $mysqli->real_escape_string($text);
    $tags = $mysqli->real_escape_string($tags);
    $tags_json = $mysqli->real_escape_string(json_encode($tag_names));
    $encrypt = $encrypt ? '1' : '0';
    $update_time = time();

    $sql = "update notes set text = '$text',"
        ." tags = '$tags', tags_json = '$tags_json', encrypt = $encrypt,"
        ." update_time = $update_time, revision = revision + 1"
        ." where id_users = $id_users and id_notes = $id";

    $mysqli->query($sql) || trigger_error($mysqli->error);

}
