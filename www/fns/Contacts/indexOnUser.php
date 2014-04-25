<?php

namespace Contacts;

function indexOnUser ($mysqli, $id_users) {
    $sql = "select * from contacts where id_users = $id_users"
        ." order by favorite desc, full_name";
    include_once __DIR__.'/../mysqli_query_object.php';
    return mysqli_query_object($mysqli, $sql);
}
