<?php

namespace Invitations;

function index ($mysqli) {
    include_once __DIR__.'/../mysqli_query_object.php';
    return mysqli_query_object($mysqli, 'select * from invitations');
}
