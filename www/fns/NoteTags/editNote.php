<?php

namespace NoteTags;

function editNote ($mysqli, $id_notes, $text,
    $encrypted_text, $encrypted_text_iv, $title, $encrypted_title,
    $encrypted_title_iv, $tags, $tag_names, $encrypt_in_listings,
    $password_protect, $insert_time, $update_time) {

    $text = $mysqli->real_escape_string($text);
    if ($encrypted_text === null) {
        $encrypted_text = $encrypted_text_iv = 'null';
        $encrypted_title = $encrypted_title_iv = 'null';
    } else {
        $encrypted_text = "'".$mysqli->real_escape_string($encrypted_text)."'";
        $encrypted_title = $mysqli->real_escape_string($encrypted_title);
        $encrypted_title = "'$encrypted_title'";
    }
    $title = $mysqli->real_escape_string($title);
    $tags = $mysqli->real_escape_string($tags);
    $num_tags = count($tag_names);
    $tags_json = $mysqli->real_escape_string(json_encode($tag_names));
    $encrypt_in_listings = $encrypt_in_listings ? '1' : '0';
    $password_protect = $password_protect ? '1' : '0';

    $sql = "update note_tags set text = '$text',"
        ." encrypted_text = $encrypted_text,"
        ." encrypted_text_iv = $encrypted_text_iv, title = '$title',"
        ." encrypted_title = $encrypted_title,"
        ." encrypted_title_iv = $encrypted_title_iv, tags = '$tags',"
        ." num_tags = $num_tags, tags_json = '$tags_json',"
        ." encrypt_in_listings = $encrypt_in_listings,"
        ." password_protect = $password_protect, insert_time = $insert_time,"
        ." update_time = $update_time where id_notes = $id_notes";

    $mysqli->query($sql) || trigger_error($mysqli->error);

}
