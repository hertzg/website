<?php

namespace NoteTags;

function add ($mysqli, $id_users, $id_notes, $tag_names, $text, $encrypt) {

    $text = $mysqli->real_escape_string($text);
    $encrypt = $encrypt ? '1' : '0';
    $insert_time = $update_time = time();

    $sql = 'insert into note_tags (id_users, id_notes, tag_name,'
        .' text, encrypt, insert_time, update_time) values';
    foreach ($tag_names as $i => $tag_name) {
        if ($i) $sql .= ', ';
        $tag_name = $mysqli->real_escape_string($tag_name);
        $sql .= "($id_users, $id_notes, '$tag_name',"
            ." '$text', $encrypt, $insert_time, $update_time)";
    }
    $mysqli->query($sql) || trigger_error($mysqli->error);

}
