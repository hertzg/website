<?php

namespace NoteTags;

function add ($mysqli, $id_users, $id_notes,
    $tag_names, $text, $encrypted_text, $encrypted_text_iv,
    $title, $encrypted_title, $encrypted_title_iv, $tags,
    $encrypt_in_listings, $password_protect, $insert_time, $update_time) {

    $text = $mysqli->real_escape_string($text);
    $title = $mysqli->real_escape_string($title);
    if ($encrypted_text === null) {
        $encrypted_text = $encrypted_text_iv = 'null';
        $encrypted_title = $encrypted_title_iv = 'null';
    } else {
        $encrypted_text = "'".$mysqli->real_escape_string($encrypted_text)."'";
        $encrypted_title = $mysqli->real_escape_string($encrypted_title);
        $encrypted_title = "'$encrypted_title'";
    }
    $tags = $mysqli->real_escape_string($tags);
    $num_tags = count($tag_names);
    $tags_json = $mysqli->real_escape_string(json_encode($tag_names));
    $encrypt_in_listings = $encrypt_in_listings ? '1' : '0';
    $password_protect = $password_protect ? '1' : '0';

    $sql = 'insert into note_tags'
        .' (id_users, id_notes, tag_name, text,'
        .' encrypted_text, encrypted_text_iv, title,'
        .' encrypted_title, encrypted_title_iv, tags,'
        .' num_tags, tags_json, encrypt_in_listings,'
        .' password_protect, insert_time, update_time) values';
    foreach ($tag_names as $i => $tag_name) {
        if ($i) $sql .= ', ';
        $tag_name = $mysqli->real_escape_string($tag_name);
        $sql .= "($id_users, $id_notes, '$tag_name', '$text',"
            ." $encrypted_text, $encrypted_text_iv, '$title',"
            ." $encrypted_title, $encrypted_title_iv, '$tags',"
            ." $num_tags, '$tags_json', $encrypt_in_listings,"
            ." $password_protect, $insert_time, $update_time)";
    }
    $mysqli->query($sql) || trigger_error($mysqli->error);

}
