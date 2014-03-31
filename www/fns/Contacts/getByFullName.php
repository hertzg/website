<?php

namespace Contacts;

function getByFullName ($mysqli, $id_users, $full_name, $excludeid = 0) {

    $full_name = $mysqli->real_escape_string($full_name);

    include_once __DIR__.'/../mysqli_single_object.php';
    return mysqli_single_object(
        $mysqli,
        'select * from contacts'
        ." where id_users = $id_users"
        ." and full_name = '$full_name'"
        ." and id_contacts != $excludeid"
    );

}
