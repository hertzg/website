<?php

namespace Notes;

function edit ($mysqli, $id, $text, $tags, $tag_names, $encrypt) {

    $text = $mysqli->real_escape_string($text);
    $tags = $mysqli->real_escape_string($tags);
    $num_tags = count($tag_names);
    $tags_json = $mysqli->real_escape_string(json_encode($tag_names));
    $encrypt = $encrypt ? '1' : '0';
    $update_time = time();

    $sql = "update notes set text = '$text', tags = '$tags',"
        ." num_tags = $num_tags, tags_json = '$tags_json', encrypt = $encrypt,"
        ." update_time = $update_time, revision = revision + 1 where id = $id";

    $mysqli->query($sql) || trigger_error($mysqli->error);

}
