<?php

namespace Contacts;

function edit ($mysqli, $id_users, $id, $full_name, $alias, $address,
    $email, $phone1, $phone2, $username, $tags) {

    $full_name = $mysqli->real_escape_string($full_name);
    $alias = $mysqli->real_escape_string($alias);
    $address = $mysqli->real_escape_string($address);
    $email = $mysqli->real_escape_string($email);
    $phone1 = $mysqli->real_escape_string($phone1);
    $phone2 = $mysqli->real_escape_string($phone2);
    $username = $mysqli->real_escape_string($username);
    $tags = $mysqli->real_escape_string($tags);
    $update_time = time();

    $sql = "update contacts set full_name = '$full_name',"
        ." alias = '$alias', address = '$address', email = '$email',"
        ." phone1 = '$phone1', phone2 = '$phone2', username = '$username',"
        ." tags = '$tags', update_time = $update_time"
        ." where id_users = $id_users and id_contacts = $id";

    $mysqli->query($sql) || trigger_error($mysqli->error);

}
