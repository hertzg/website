<?php

namespace Contacts;

function addDeleted ($mysqli, $id, $id_users, $full_name, $alias,
    $address, $email, $phone1, $phone2, $birthday_time, $username,
    $timezone, $tags, $tag_names, $notes, $favorite, $insert_time,
    $update_time, $photo_id) {

    $full_name = $mysqli->real_escape_string($full_name);
    $alias = $mysqli->real_escape_string($alias);
    $address = $mysqli->real_escape_string($address);
    $email = $mysqli->real_escape_string($email);
    $phone1 = $mysqli->real_escape_string($phone1);
    $phone2 = $mysqli->real_escape_string($phone2);
    if ($birthday_time === null) $birthday_time = 'null';
    $username = $mysqli->real_escape_string($username);
    if ($timezone === null) $timezone = 'null';
    $tags = $mysqli->real_escape_string($tags);
    $tags_json = $mysqli->real_escape_string(json_encode($tag_names));
    $notes = $mysqli->real_escape_string($notes);
    $favorite = $favorite ? '1' : '0';
    if ($photo_id === null) $photo_id = 'null';

    $sql = 'insert into contacts'
        .' (id_contacts, id_users, full_name, alias, address,'
        .' email, phone1, phone2, birthday_time, username,'
        .' timezone, tags, tags_json, notes, favorite,'
        .' insert_time, update_time, photo_id)'
        ." values ($id, $id_users, '$full_name', '$alias', '$address',"
        ." '$email', '$phone1', '$phone2', $birthday_time, '$username',"
        ." $timezone, '$tags', '$tags_json', '$notes', $favorite,"
        ." $insert_time, $update_time, $photo_id)";

    $mysqli->query($sql) || trigger_error($mysqli->error);

}
