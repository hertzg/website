<?php

namespace Contacts;

function edit ($mysqli, $idusers, $id, $fullname, $address,
    $email, $phone1, $phone2, $tags) {

    $fullname = $mysqli->real_escape_string($fullname);
    $address = $mysqli->real_escape_string($address);
    $email = $mysqli->real_escape_string($email);
    $phone1 = $mysqli->real_escape_string($phone1);
    $phone2 = $mysqli->real_escape_string($phone2);
    $tags = $mysqli->real_escape_string($tags);
    $update_time = time();

    $sql = 'update contacts set'
        ." fullname = '$fullname', address = '$address',"
        ." email = '$email', phone1 = '$phone1',"
        ." phone2 = '$phone2', tags = '$tags',"
        ." update_time = $update_time"
        ." where idusers = $idusers and idcontacts = $id";

    $mysqli->query($sql);

}
