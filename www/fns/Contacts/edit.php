<?php

namespace Contacts;

function edit ($mysqli, $idusers, $id, $fullname, $address,
    $email, $phone1, $phone2, $tags) {

    $fullname = mysqli_real_escape_string($mysqli, $fullname);
    $address = mysqli_real_escape_string($mysqli, $address);
    $email = mysqli_real_escape_string($mysqli, $email);
    $phone1 = mysqli_real_escape_string($mysqli, $phone1);
    $phone2 = mysqli_real_escape_string($mysqli, $phone2);
    $tags = mysqli_real_escape_string($mysqli, $tags);
    mysqli_query(
        $mysqli,
        'update contacts set'
        ." fullname = '$fullname',"
        ." address = '$address',"
        ." email = '$email',"
        ." phone1 = '$phone1',"
        ." phone2 = '$phone2',"
        ." tags = '$tags'"
        ." where idusers = $idusers and idcontacts = $id"
    );

}
