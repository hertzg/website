<?php

namespace SendingContacts;

function index ($mysqli) {
    $sql = 'select * from sending_contacts order by insert_time';
    include_once __DIR__.'/../mysqli_query_object.php';
    return mysqli_query_object($mysqli, $sql);
}
