<?php

namespace NoteTags;

function add ($mysqli, $id_users, $id_notes, $tag_names, $text,
    $title, $tags, $encrypt_in_listings, $password_protect) {

    $text = $mysqli->real_escape_string($text);
    $title = $mysqli->real_escape_string($title);
    $tags = $mysqli->real_escape_string($tags);
    $num_tags = count($tag_names);
    $tags_json = $mysqli->real_escape_string(json_encode($tag_names));
    $encrypt_in_listings = $encrypt_in_listings ? '1' : '0';
    $password_protect = $password_protect ? '1' : '0';
    $insert_time = $update_time = time();

    $sql = 'insert into note_tags'
        .' (id_users, id_notes, tag_name, text, title,'
        .' tags, num_tags, tags_json, encrypt_in_listings,'
        .' password_protect, insert_time, update_time) values';
    foreach ($tag_names as $i => $tag_name) {
        if ($i) $sql .= ', ';
        $tag_name = $mysqli->real_escape_string($tag_name);
        $sql .= "($id_users, $id_notes, '$tag_name', '$text', '$title',"
            ." '$tags', $num_tags, '$tags_json', $encrypt_in_listings,"
            ." $password_protect, $insert_time, $update_time)";
    }
    $mysqli->query($sql) || trigger_error($mysqli->error);

}
