<?php

namespace Contacts;

function add ($mysqli, $idusers, $full_name, $alias, $address,
    $email, $phone1, $phone2, $tags) {

    $full_name = $mysqli->real_escape_string($full_name);
    $alias = $mysqli->real_escape_string($alias);
    $address = $mysqli->real_escape_string($address);
    $email = $mysqli->real_escape_string($email);
    $phone1 = $mysqli->real_escape_string($phone1);
    $phone2 = $mysqli->real_escape_string($phone2);
    $tags = $mysqli->real_escape_string($tags);
    $insert_time = $update_time = time();

    $sql = 'insert into contacts'
        .' (idusers, full_name, alias, address, email, '
        .'phone1, phone2, tags, insert_time, update_time)'
        ." values ($idusers, '$full_name', '$alias', '$address', '$email',"
        ." '$phone1', '$phone2', '$tags', $insert_time, $update_time)";

    $mysqli->query($sql) || trigger_error($mysqli->error);

    return $mysqli->insert_id;

}
