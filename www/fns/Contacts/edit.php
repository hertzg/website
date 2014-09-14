<?php

namespace Contacts;

function edit ($mysqli, $id_users, $id,
    $full_name, $alias, $address, $email, $phone1, $phone2,
    $birthday_time, $username, $timezone, $tags, $favorite) {

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
    $favorite = $favorite ? '1' : '0';
    $update_time = time();

    $sql = "update contacts set full_name = '$full_name',"
        ." alias = '$alias', address = '$address', email = '$email',"
        ." phone1 = '$phone1', phone2 = '$phone2',"
        ." birthday_time = $birthday_time, birthday_day = $birthday_day,"
        ." birthday_month = $birthday_month, username = '$username',"
        ." timezone = $timezone, tags = '$tags',"
        ." favorite = $favorite, update_time = $update_time,"
        ." num_edits = num_edits + 1 where id_users = $id_users"
        ." and id_contacts = $id";

    $mysqli->query($sql) || trigger_error($mysqli->error);

}
