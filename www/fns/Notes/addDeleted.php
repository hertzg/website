<?php

namespace Notes;

function addDeleted ($mysqli, $id, $id_users,
    $text, $encrypted_text, $encrypted_text_iv,
    $title, $encrypted_title, $encrypted_title_iv,
    $tags, $tag_names, $encrypt_in_listings,
    $password_protect, $insert_time, $update_time, $revision) {

    $text = $mysqli->real_escape_string($text);
    if ($encrypted_text === null) {
        $encrypted_text = $encrypted_text_iv = 'null';
    } else {
        $encrypted_text = "'".$mysqli->real_escape_string($encrypted_text)."'";
    }
    $title = $mysqli->real_escape_string($title);
    if ($encrypted_title === null) {
        $encrypted_title = $encrypted_title_iv = 'null';
    } else {
        $encrypted_title = $mysqli->real_escape_string($encrypted_title);
        $encrypted_title = "'$encrypted_title'";
    }
    $tags = $mysqli->real_escape_string($tags);
    $num_tags = count($tag_names);
    $tags_json = $mysqli->real_escape_string(json_encode($tag_names));
    $encrypt_in_listings = $encrypt_in_listings ? '1' : '0';
    $password_protect = $password_protect ? '1' : '0';

    $sql = 'insert into notes'
        .' (id, id_users, text, encrypted_text,'
        .' encrypted_text_iv, title, encrypted_title,'
        .' encrypted_title_iv, tags, num_tags, tags_json,'
        .' encrypt_in_listings, password_protect,'
        .' insert_time, update_time, revision)'
        ." values ($id, $id_users, '$text', $encrypted_text,"
        ." $encrypted_text_iv, '$title', $encrypted_title,"
        ." $encrypted_title_iv, '$tags', $num_tags, '$tags_json',"
        ." $encrypt_in_listings, $password_protect,"
        ." $insert_time, $update_time, $revision)";

    $mysqli->query($sql) || trigger_error($mysqli->error);

}
