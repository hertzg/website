<?php

namespace Contacts;

function indexWithUsernameOnUser ($mysqli, $id_users) {
    $sql = "select * from contacts where id_users = $id_users"
        ." and username != '' order by favorite desc, full_name";
    include_once __DIR__.'/../mysqli_query_object.php';
    return mysqli_query_object($mysqli, $sql);
}
