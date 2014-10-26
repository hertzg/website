<?php

namespace Schedules;

function edit ($mysqli, $id, $text, $interval, $offset, $tags, $tag_names) {

    $text = $mysqli->real_escape_string($text);
    $tags = $mysqli->real_escape_string($tags);
    $num_tags = count($tag_names);
    $tags_json = $mysqli->real_escape_string(json_encode($tag_names));
    $update_time = time();

    $sql = "update schedules set text = '$text', `interval` = $interval,"
        ." offset = $offset, tags = '$tags', num_tags = $num_tags,"
        ." tags_json = '$tags_json', update_time = $update_time,"
        ." revision = revision + 1 where id = $id";

    $mysqli->query($sql) || trigger_error($mysqli->error);

}
