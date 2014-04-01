<?php

namespace ReceivedContacts;

function add ($mysqli, $sender_id_users, $sender_username, $receiver_id_users,
    $full_name, $alias, $address, $email, $phone1, $phone2, $username, $tags) {

    $sender_username = $mysqli->real_escape_string($sender_username);
    $full_name = $mysqli->real_escape_string($full_name);
    $alias = $mysqli->real_escape_string($alias);
    $address = $mysqli->real_escape_string($address);
    $email = $mysqli->real_escape_string($email);
    $phone1 = $mysqli->real_escape_string($phone1);
    $phone2 = $mysqli->real_escape_string($phone2);
    $username = $mysqli->real_escape_string($username);
    $tags = $mysqli->real_escape_string($tags);
    $insert_time = time();

    $sql = 'insert into received_contacts'
        .' (sender_id_users, sender_username, receiver_id_users,'
        .' full_name, alias, address, email, phone1,'
        .' phone2, username, tags, insert_time)'
        ." values ($sender_id_users, '$sender_username', $receiver_id_users,"
        ." '$full_name', '$alias', '$address', '$email', '$phone1',"
        ." '$phone2', '$username', '$tags', $insert_time)";
    $mysqli->query($sql) || trigger_error($mysqli->error);

}
