<?php

namespace Notes;

function add ($mysqli, $id_users, $text, $encrypted_text,
    $encrypted_text_iv, $title, $encrypted_title, $encrypted_title_iv,
    $tags, $tag_names, $encrypt_in_listings, $password_protect,
    $insert_time, $update_time, $insertApiKey) {

    $text = $mysqli->real_escape_string($text);
    // TODO join ifs
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
    if ($insertApiKey === null) {
        $insert_api_key_id = $insert_api_key_name = 'null';
    } else {

        $insert_api_key_id = $insertApiKey->id;

        $name = $insertApiKey->name;
        $insert_api_key_name = "'".$mysqli->real_escape_string($name)."'";

    }

    $sql = 'insert into notes'
        .' (id_users, text, encrypted_text,'
        .' encrypted_text_iv, title, encrypted_title,'
        .' encrypted_title_iv, tags, num_tags, tags_json,'
        .' encrypt_in_listings, password_protect, insert_time,'
        .' update_time, insert_api_key_id, insert_api_key_name)'
        ." values ($id_users, '$text', $encrypted_text,"
        ." $encrypted_text_iv, '$title', $encrypted_title,"
        ." '$encrypted_title_iv', '$tags', $num_tags, '$tags_json',"
        ." $encrypt_in_listings, $password_protect, $insert_time,"
        ." $update_time, $insert_api_key_id, $insert_api_key_name)";

    $mysqli->query($sql) || trigger_error($mysqli->error);

    return $mysqli->insert_id;

}
