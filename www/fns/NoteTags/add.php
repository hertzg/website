<?php

namespace NoteTags;

function add ($mysqli, $id_users, $id_notes,
    $tag_names, $text, $title, $tags, $encrypt) {

    $text = $mysqli->real_escape_string($text);
    $title = $mysqli->real_escape_string($title);
    $tags = $mysqli->real_escape_string($tags);
    $encrypt = $encrypt ? '1' : '0';
    $insert_time = $update_time = time();

    $sql = 'insert into note_tags (id_users, id_notes, tag_name,'
        .' text, title, tags, encrypt, insert_time, update_time) values';
    foreach ($tag_names as $i => $tag_name) {
        if ($i) $sql .= ', ';
        $tag_name = $mysqli->real_escape_string($tag_name);
        $sql .= "($id_users, $id_notes, '$tag_name', '$text', '$title',"
            ." '$tags', $encrypt, $insert_time, $update_time)";
    }
    $mysqli->query($sql) || trigger_error($mysqli->error);

}
