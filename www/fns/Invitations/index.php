<?php

namespace Invitations;

function index ($mysqli) {
    $sql = 'select * from invitations order by update_time';
    include_once __DIR__.'/../mysqli_query_object.php';
    return mysqli_query_object($mysqli, $sql);
}
