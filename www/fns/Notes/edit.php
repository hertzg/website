<?php

namespace Notes;

function edit ($mysqli, $id, $text, $title, $tags, $tag_names,
    $encrypt_in_listings, $password_protect, $updateApiKey) {

    $text = $mysqli->real_escape_string($text);
    $title = $mysqli->real_escape_string($title);
    $tags = $mysqli->real_escape_string($tags);
    $num_tags = count($tag_names);
    $tags_json = $mysqli->real_escape_string(json_encode($tag_names));
    $encrypt_in_listings = $encrypt_in_listings ? '1' : '0';
    $password_protect = $password_protect ? '1' : '0';
    $update_time = time();
    if ($updateApiKey === null) {
        $update_api_key_id = $update_api_key_name = 'null';
    } else {

        $update_api_key_id = $updateApiKey->id;

        $name = $updateApiKey->name;
        $update_api_key_name = "'".$mysqli->real_escape_string($name)."'";

    }

    $sql = "update notes set text = '$text', title = '$title',"
        ." tags = '$tags', num_tags = $num_tags, tags_json = '$tags_json',"
        ." encrypt_in_listings = $encrypt_in_listings,"
        ." password_protect = $password_protect, update_time = $update_time,"
        ." update_api_key_id = $update_api_key_id,"
        ." update_api_key_name = $update_api_key_name,"
        ." revision = revision + 1 where id = $id";

    $mysqli->query($sql) || trigger_error($mysqli->error);

}
