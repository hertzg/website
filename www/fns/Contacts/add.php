<?php

namespace Contacts;

function add ($mysqli, $id_users, $full_name,
    $alias, $address, $email1, $email1_label, $email2,
    $email2_label, $phone1, $phone1_label, $phone2,
    $phone2_label, $birthday_time, $username, $timezone,
    $tags, $tag_names, $notes, $favorite, $photo_id,
    $insert_time, $update_time, $insertApiKey) {

    $full_name = $mysqli->real_escape_string($full_name);
    $alias = $mysqli->real_escape_string($alias);
    $address = $mysqli->real_escape_string($address);
    $email1 = $mysqli->real_escape_string($email1);
    $email1_label = $mysqli->real_escape_string($email1_label);
    $email2 = $mysqli->real_escape_string($email2);
    $email2_label = $mysqli->real_escape_string($email2_label);
    $phone1 = $mysqli->real_escape_string($phone1);
    $phone1_label = $mysqli->real_escape_string($phone1_label);
    $phone2 = $mysqli->real_escape_string($phone2);
    $phone2_label = $mysqli->real_escape_string($phone2_label);
    if ($birthday_time === null) {
        $birthday_time = $birthday_day =
            $birthday_month = $birthday_year = 'null';
    } else {
        $birthday_day = date('j', $birthday_time);
        $birthday_month = date('n', $birthday_time);
        $birthday_year = date('Y', $birthday_time);
    }
    $username = $mysqli->real_escape_string($username);
    if ($timezone === null) $timezone = 'null';
    $tags = $mysqli->real_escape_string($tags);
    $num_tags = count($tag_names);
    $tags_json = $mysqli->real_escape_string(json_encode($tag_names));
    $notes = $mysqli->real_escape_string($notes);
    $favorite = $favorite ? '1' : '0';
    if ($photo_id === null) $photo_id = 'null';
    if ($insertApiKey === null) {
        $insert_api_key_id = $insert_api_key_name = 'null';
    } else {

        $insert_api_key_id = $insertApiKey->id;

        $name = $insertApiKey->name;
        $insert_api_key_name = "'".$mysqli->real_escape_string($name)."'";

    }

    $sql = 'insert into contacts'
        .' (id_users, full_name, alias, address,'
        .' email1, email1_label, email2, email2_label,'
        .' phone1, phone1_label, phone2, phone2_label,'
        .' birthday_time, birthday_day, birthday_month,'
        .' birthday_year, username, timezone, tags, num_tags,'
        .' tags_json, notes, favorite, photo_id, insert_time,'
        .' update_time, insert_api_key_id, insert_api_key_name)'
        ." values ($id_users, '$full_name', '$alias', '$address',"
        ." '$email1', '$email1_label', '$email2', '$email2_label',"
        ." '$phone1', '$phone1_label', '$phone2', '$phone2_label',"
        ." $birthday_time, $birthday_day, $birthday_month,"
        ." $birthday_year, '$username', $timezone, '$tags', $num_tags,"
        ." '$tags_json', '$notes', $favorite, $photo_id, $insert_time,"
        ." $update_time, $insert_api_key_id, $insert_api_key_name)";

    $mysqli->query($sql) || trigger_error($mysqli->error);

    return $mysqli->insert_id;

}
