<?php

namespace Notes;

function add ($mysqli, $id_users, $text, $title,
    $tags, $tag_names, $encrypt_in_listings, $insertApiKey) {

    $text = $mysqli->real_escape_string($text);
    $title = $mysqli->real_escape_string($title);
    $tags = $mysqli->real_escape_string($tags);
    $num_tags = count($tag_names);
    $tags_json = $mysqli->real_escape_string(json_encode($tag_names));
    $encrypt_in_listings = $encrypt_in_listings ? '1' : '0';
    $insert_time = $update_time = time();
    if ($insertApiKey === null) {
        $insert_api_key_id = $insert_api_key_name = 'null';
    } else {

        $insert_api_key_id = $insertApiKey->id;

        $name = $insertApiKey->name;
        $insert_api_key_name = "'".$mysqli->real_escape_string($name)."'";

    }

    $sql = 'insert into notes'
        .' (id_users, text, title, tags, num_tags,'
        .' tags_json, encrypt_in_listings, insert_time, update_time,'
        .' insert_api_key_id, insert_api_key_name)'
        ." values ($id_users, '$text', '$title', '$tags', $num_tags,"
        ." '$tags_json', $encrypt_in_listings, $insert_time, $update_time,"
        ." $insert_api_key_id, $insert_api_key_name)";

    $mysqli->query($sql) || trigger_error($mysqli->error);

    return $mysqli->insert_id;

}
