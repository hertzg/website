<?php

namespace Contacts;

function add ($mysqli, $idusers, $fullname, $address,
    $email, $phone1, $phone2, $tags) {

    $fullname = mysqli_real_escape_string($mysqli, $fullname);
    $address = mysqli_real_escape_string($mysqli, $address);
    $email = mysqli_real_escape_string($mysqli, $email);
    $phone1 = mysqli_real_escape_string($mysqli, $phone1);
    $phone2 = mysqli_real_escape_string($mysqli, $phone2);
    $tags = mysqli_real_escape_string($mysqli, $tags);
    mysqli_query(
        $mysqli,
        'insert into contacts'
        .' (idusers, fullname, address,'
        .' email, phone1, phone2, tags)'
        ." values ($idusers, '$fullname', '$address',"
        ." '$email', '$phone1', '$phone2', '$tags')"
    );
    return mysqli_insert_id($mysqli);

}
