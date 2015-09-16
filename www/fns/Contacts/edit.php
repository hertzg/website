<?php

namespace Contacts;

function edit ($mysqli, $id, $full_name, $alias, $address,
    $email, $phone1, $phone2, $birthday_time, $username, $timezone,
    $tags, $tag_names, $notes, $favorite, $update_time, $updateApiKey) {

    $full_name = $mysqli->real_escape_string($full_name);
    $alias = $mysqli->real_escape_string($alias);
    $address = $mysqli->real_escape_string($address);
    $email = $mysqli->real_escape_string($email);
    $phone1 = $mysqli->real_escape_string($phone1);
    $phone2 = $mysqli->real_escape_string($phone2);
    if ($birthday_time === null) {
        $birthday_time = $birthday_day = $birthday_month = 'null';
    } else {
        $birthday_day = date('j', $birthday_time);
        $birthday_month = date('n', $birthday_time);
    }
    $username = $mysqli->real_escape_string($username);
    if ($timezone === null) $timezone = 'null';
    $tags = $mysqli->real_escape_string($tags);
    $num_tags = count($tag_names);
    $tags_json = $mysqli->real_escape_string(json_encode($tag_names));
    $notes = $mysqli->real_escape_string($notes);
    $favorite = $favorite ? '1' : '0';
    if ($updateApiKey === null) {
        $update_api_key_id = $update_api_key_name = 'null';
    } else {

        $update_api_key_id = $updateApiKey->id;

        $name = $updateApiKey->name;
        $update_api_key_name = "'".$mysqli->real_escape_string($name)."'";

    }

    $sql = "update contacts set full_name = '$full_name',"
        ." alias = '$alias', address = '$address', email = '$email',"
        ." phone1 = '$phone1', phone2 = '$phone2',"
        ." birthday_time = $birthday_time, birthday_day = $birthday_day,"
        ." birthday_month = $birthday_month, username = '$username',"
        ." timezone = $timezone, tags = '$tags',"
        ." num_tags = $num_tags, tags_json = '$tags_json',"
        ." notes = '$notes', favorite = $favorite, update_time = $update_time,"
        ." update_api_key_id = $update_api_key_id,"
        ." update_api_key_name = $update_api_key_name,"
        ." revision = revision + 1 where id = $id";

    $mysqli->query($sql) || trigger_error($mysqli->error);

}
