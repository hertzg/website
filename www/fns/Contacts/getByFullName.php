<?php

namespace Contacts;

function getByFullName ($mysqli, $idusers, $fullname, $excludeid = 0) {

    $fullname = $mysqli->real_escape_string($fullname);

    include_once __DIR__.'/../mysqli_single_object.php';
    return mysqli_single_object(
        $mysqli,
        'select * from contacts'
        ." where idusers = $idusers"
        ." and fullname = '$fullname'"
        ." and idcontacts != $excludeid"
    );

}
