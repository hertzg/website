<?php

namespace ReceivedContacts;

function addDeleted ($mysqli, $id, $sender_address,
    $sender_id_users, $sender_username, $receiver_id_users,
    $full_name, $alias, $address, $email1, $email1_label, $email2,
    $email2_label, $phone1, $phone1_label, $phone2, $phone2_label,
    $birthday_time, $username, $timezone, $tags, $notes,
    $favorite, $archived, $insert_time, $photo_id) {

    if ($sender_address === null) $sender_address = 'null';
    else $sender_address = "'".$mysqli->real_escape_string($sender_address)."'";
    if ($sender_id_users === null) $sender_id_users = 'null';
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
    $archived = $archived ? '1' : '0';
    if ($photo_id === null) $photo_id = 'null';

    $sql = 'insert into received_contacts'
        .' (id, sender_address, sender_id_users, sender_username,'
        .' receiver_id_users, full_name, alias, address,'
        .' email1, email1_label, email2, email2_label,'
        .' phone1, phone1_label, phone2, phone2_label,'
        .' birthday_time, username, timezone, tags,'
        .' notes, favorite, archived, insert_time, photo_id)'
        ." values ($id, $sender_address, $sender_id_users, '$sender_username',"
        ." $receiver_id_users, '$full_name', '$alias', '$address',"
        ." '$email1', '$email1_label', '$email2', '$email2_label',"
        ." '$phone1', '$phone1_label', '$phone2', '$phone2_label',"
        ." $birthday_time, '$username', $timezone, '$tags',"
        ." '$notes', $favorite, $archived, $insert_time, $photo_id)";
    $mysqli->query($sql) || trigger_error($mysqli->error);

}
