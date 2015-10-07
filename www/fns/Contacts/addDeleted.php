<?php

namespace Contacts;

function addDeleted ($mysqli, $id, $id_users, $full_name, $alias,
    $address, $email, $phone1, $phone1_label, $phone2, $phone2_label,
    $birthday_time, $username, $timezone, $tags, $tag_names, $notes,
    $favorite, $insert_time, $update_time, $photo_id, $revision) {

    $full_name = $mysqli->real_escape_string($full_name);
    $alias = $mysqli->real_escape_string($alias);
    $address = $mysqli->real_escape_string($address);
    $email = $mysqli->real_escape_string($email);
    $phone1 = $mysqli->real_escape_string($phone1);
    $phone1_label = $mysqli->real_escape_string($phone1_label);
    $phone2 = $mysqli->real_escape_string($phone2);
    $phone2_label = $mysqli->real_escape_string($phone2_label);
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
    if ($photo_id === null) $photo_id = 'null';

    $sql = 'insert into contacts'
        .' (id, id_users, full_name, alias, address,'
        .' email, phone1, phone1_label, phone2, phone2_label,'
        .' birthday_time, birthday_day, birthday_month, username,'
        .' timezone, tags, num_tags, tags_json, notes, favorite,'
        .' insert_time, update_time, photo_id, revision)'
        ." values ($id, $id_users, '$full_name', '$alias', '$address',"
        ." '$email', '$phone1', '$phone1_label', '$phone2', '$phone2_label',"
        ." $birthday_time, $birthday_day, $birthday_month, '$username',"
        ." $timezone, '$tags', $num_tags, '$tags_json', '$notes', $favorite,"
        ." $insert_time, $update_time, $photo_id, $revision)";

    $mysqli->query($sql) || trigger_error($mysqli->error);

}
