<?php

namespace Schedules;

function addDeleted ($mysqli, $id, $id_users, $text, $interval, $offset,
    $tags, $tag_names, $insert_time, $update_time, $revision) {

    $text = $mysqli->real_escape_string($text);
    $tags = $mysqli->real_escape_string($tags);
    $num_tags = count($tag_names);
    $tags_json = $mysqli->real_escape_string(json_encode($tag_names));

    $sql = 'insert into schedules'
        .' (id, id_users, text, `interval`,'
        .' offset, tags, num_tags, tags_json,'
        .' insert_time, update_time, revision)'
        ." values ($id, $id_users, '$text', $interval,"
        ." $offset, '$tags', $num_tags, '$tags_json',"
        ." $insert_time, $update_time, $revision)";

    $mysqli->query($sql) || trigger_error($mysqli->error);

    return $mysqli->insert_id;

}
