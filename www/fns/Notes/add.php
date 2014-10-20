<?php

namespace Notes;

function add ($mysqli, $id_users, $text, $tags, $tag_names, $encrypt) {

    $text = $mysqli->real_escape_string($text);
    $tags = $mysqli->real_escape_string($tags);
    $num_tags = count($tag_names);
    $tags_json = $mysqli->real_escape_string(json_encode($tag_names));
    $encrypt = $encrypt ? '1' : '0';
    $insert_time = $update_time = time();

    $sql = 'insert into notes'
        .' (id_users, text, tags, num_tags,'
        .' tags_json, encrypt, insert_time, update_time)'
        ." values ($id_users, '$text', '$tags', $num_tags,"
        ." '$tags_json', $encrypt, $insert_time, $update_time)";

    $mysqli->query($sql) || trigger_error($mysqli->error);

    return $mysqli->insert_id;

}
