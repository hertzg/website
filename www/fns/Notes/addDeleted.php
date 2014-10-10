<?php

namespace Notes;

function addDeleted ($mysqli, $id, $id_users,
    $text, $tags, $tag_names, $encrypt, $insert_time, $update_time) {

    $text = $mysqli->real_escape_string($text);
    $tags = $mysqli->real_escape_string($tags);
    $tags_json = $mysqli->real_escape_string(json_encode($tag_names));
    $encrypt = $encrypt ? '1' : '0';

    $sql = 'insert into notes'
        .' (id_notes, id_users, text, tags, tags_json,'
        .' encrypt, insert_time, update_time)'
        ." values ($id, $id_users, '$text', '$tags', '$tags_json',"
        ." $encrypt, $insert_time, $update_time)";

    $mysqli->query($sql) || trigger_error($mysqli->error);

}
