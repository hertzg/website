<?php

namespace NoteTags;

function add ($mysqli, $id_users, $id_notes, $tag_names, $text, $encrypt) {

    $text = $mysqli->real_escape_string($text);
    $encrypt = $encrypt ? '1' : '0';
    $insert_time = $update_time = time();

    foreach ($tag_names as $tag_name) {
        $tag_name = $mysqli->real_escape_string($tag_name);
        $sql = 'insert into note_tags (id_users, id_notes, tag_name,'
            .' text, encrypt, insert_time, update_time)'
            ." values ($id_users, $id_notes, '$tag_name',"
            ." '$text', $encrypt, $insert_time, $update_time)";
        $mysqli->query($sql) || trigger_error($mysqli->error);
    }

}
