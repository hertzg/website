<?php

namespace Contacts;

function add ($mysqli, $id_users, $full_name, $alias,
    $address, $email, $phone1, $phone2, $birthday_time, $username,
    $timezone, $tags, $tag_names, $notes, $favorite, $photo_id) {

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
    $tags_json = $mysqli->real_escape_string(json_encode($tag_names));
    $notes = $mysqli->real_escape_string($notes);
    $favorite = $favorite ? '1' : '0';
    if ($photo_id === null) $photo_id = 'null';
    $insert_time = $update_time = time();

    $sql = 'insert into contacts'
        .' (id_users, full_name, alias, address, email,'
        .' phone1, phone2, birthday_time, birthday_day,'
        .' birthday_month, username, timezone, tags, tags_json,'
        .' notes, favorite, photo_id, insert_time, update_time)'
        ." values ($id_users, '$full_name', '$alias', '$address', '$email',"
        ." '$phone1', '$phone2', $birthday_time, $birthday_day,"
        ." $birthday_month, '$username', $timezone, '$tags', '$tags_json',"
        ." '$notes', $favorite, $photo_id, $insert_time, $update_time)";

    $mysqli->query($sql) || trigger_error($mysqli->error);

    return $mysqli->insert_id;

}
