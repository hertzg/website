<?php

namespace Contacts;

function getByFullName ($mysqli, $idusers, $full_name, $excludeid = 0) {

    $full_name = $mysqli->real_escape_string($full_name);

    include_once __DIR__.'/../mysqli_single_object.php';
    return mysqli_single_object(
        $mysqli,
        'select * from contacts'
        ." where idusers = $idusers"
        ." and full_name = '$full_name'"
        ." and idcontacts != $excludeid"
    );

}
