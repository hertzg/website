<?php

namespace Contacts;

function index ($mysqli, $idusers) {
    $sql = 'select * from contacts'
        ." where idusers = $idusers"
        .' order by fullname';
    include_once __DIR__.'/../mysqli_query_object.php';
    return mysqli_query_object($mysqli, $sql);
}
