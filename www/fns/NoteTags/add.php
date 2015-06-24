<?php

namespace NoteTags;

function add ($mysqli, $id_users, $id_notes,
    $tag_names, $text, $title, $tags, $encrypt) {

    $text = $mysqli->real_escape_string($text);
    $title = $mysqli->real_escape_string($title);
    $tags = $mysqli->real_escape_string($tags);
    $tags_json = $mysqli->real_escape_string(json_encode($tag_names));
    $encrypt = $encrypt ? '1' : '0';
    $insert_time = $update_time = time();

    $sql = 'insert into note_tags'
        .' (id_users, id_notes, tag_name,'
        .' text, title, tags, tags_json,'
        .' encrypt, insert_time, update_time) values';
    foreach ($tag_names as $i => $tag_name) {
        if ($i) $sql .= ', ';
        $tag_name = $mysqli->real_escape_string($tag_name);
        $sql .= "($id_users, $id_notes, '$tag_name',"
            ." '$text', '$title', '$tags', '$tags_json',"
            ." $encrypt, $insert_time, $update_time)";
    }
    $mysqli->query($sql) || trigger_error($mysqli->error);

}
