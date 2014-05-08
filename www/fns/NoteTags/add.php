<?php

namespace NoteTags;

function add ($mysqli, $id_users, $id_notes, array $tag_names, $text) {
    $text = $mysqli->real_escape_string($text);
    $insert_time = $update_time = time();
    foreach ($tag_names as $tag_name) {
        $tag_name = $mysqli->real_escape_string($tag_name);
        $sql = 'insert into note_tags (id_users, id_notes, tag_name,'
            .' text, insert_time, update_time)'
            ." values ($id_users, $id_notes, '$tag_name',"
            ." '$text', $insert_time, $update_time)";
        $mysqli->query($sql) || trigger_error($mysqli->error);
    }
}
