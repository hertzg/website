<?php

namespace Contacts;

function add ($mysqli, $id_users, $full_name, $alias, $address, $email,
    $phone1, $phone2, $birthday_time, $username, $tags, $favorite) {

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
    $tags = $mysqli->real_escape_string($tags);
    $favorite = $favorite ? '1' : '0';
    $insert_time = $update_time = time();

    $sql = 'insert into contacts'
        .' (id_users, full_name, alias, address, email,'
        .' phone1, phone2, birthday_time, birthday_day, birthday_month,'
        .' username, tags, favorite, insert_time, update_time)'
        ." values ($id_users, '$full_name', '$alias', '$address', '$email',"
        ." '$phone1', '$phone2', $birthday_time, $birthday_day, $birthday_month,"
        ." '$username', '$tags', $favorite, $insert_time, $update_time)";

    $mysqli->query($sql) || trigger_error($mysqli->error);

    $id_contacts = $mysqli->insert_id;

    include_once __DIR__.'/../Users/Contacts/addNumber.php';
    \Users\Contacts\addNumber($mysqli, $id_users, 1);

    return $id_contacts;

}
