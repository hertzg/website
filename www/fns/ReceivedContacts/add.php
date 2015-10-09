<?php

namespace ReceivedContacts;

function add ($mysqli, $sender_id_users, $sender_username,
    $receiver_id_users, $full_name, $alias, $address,
    $email1, $email1_label, $email2, $email2_label, $phone1,
    $phone1_label, $phone2, $phone2_label, $birthday_time,
    $username, $timezone, $tags, $notes, $favorite, $photo_id) {

    $sender_username = $mysqli->real_escape_string($sender_username);
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
    if ($birthday_time === null) $birthday_time = 'null';
    $username = $mysqli->real_escape_string($username);
    if ($timezone === null) $timezone = 'null';
    $tags = $mysqli->real_escape_string($tags);
    $notes = $mysqli->real_escape_string($notes);
    $favorite = $favorite ? '1' : '0';
    if ($photo_id === null) $photo_id = 'null';
    $insert_time = time();

    $sql = 'insert into received_contacts'
        .' (sender_id_users, sender_username, receiver_id_users,'
        .' full_name, alias, address, email1,'
        .' email1_label, email2, email2_label,'
        .' phone1, phone1_label, phone2, phone2_label,'
        .' birthday_time, username, timezone, tags,'
        .' notes, favorite, photo_id, insert_time)'
        ." values ($sender_id_users, '$sender_username', $receiver_id_users,"
        ." '$full_name', '$alias', '$address', '$email1',"
        ." '$email1_label', '$email2', '$email2_label',"
        ." '$phone1', '$phone1_label', '$phone2', '$phone2_label',"
        ." $birthday_time, '$username', $timezone, '$tags',"
        ." '$notes', $favorite, $photo_id, $insert_time)";
    $mysqli->query($sql) || trigger_error($mysqli->error);

}
