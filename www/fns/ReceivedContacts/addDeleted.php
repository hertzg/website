<?php

namespace ReceivedContacts;

function addDeleted ($mysqli, $id, $sender_id_users, $sender_username,
    $receiver_id_users, $full_name, $alias, $address, $email, $phone1,
    $phone2, $birthday_time, $username, $timezone, $tags, $favorite,
    $archived, $insert_time, $photo_id) {

    $sender_username = $mysqli->real_escape_string($sender_username);
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
    $favorite = $favorite ? '1' : '0';
    $archived = $archived ? '1' : '0';
    if ($photo_id === null) $photo_id = 'null';

    $sql = 'insert into received_contacts'
        .' (id, sender_id_users, sender_username,'
        .' receiver_id_users, full_name, alias, address, email,'
        .' phone1, phone2, birthday_time, username, timezone,'
        .' tags, favorite, archived, insert_time, photo_id)'
        ." values ($id, $sender_id_users, '$sender_username',"
        ." $receiver_id_users, '$full_name', '$alias', '$address', '$email',"
        ." '$phone1', '$phone2', $birthday_time, '$username', $timezone,"
        ." '$tags', $favorite, $archived, $insert_time, $photo_id)";
    $mysqli->query($sql) || trigger_error($mysqli->error);

}
