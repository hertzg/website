<?php

namespace NoteTags;

function editNote ($mysqli, $id_notes, $text,
    $tags, $tag_names, $encrypt, $insert_time, $update_time) {

    $text = $mysqli->real_escape_string($text);
    $tags = $mysqli->real_escape_string($tags);
    $num_tags = count($tag_names);
    $tags_json = $mysqli->real_escape_string(json_encode($tag_names));
    $encrypt = $encrypt ? '1' : '0';

    $sql = "update note_tags set text = '$text', tags = '$tags',"
        ." num_tags = $num_tags, tags_json = '$tags_json',"
        ." encrypt = $encrypt, insert_time = $insert_time,"
        ." update_time = $update_time where id_notes = $id_notes";

    $mysqli->query($sql) || trigger_error($mysqli->error);

}
