<?php

namespace Invitations;

function get ($mysqli, $id) {
    $sql = "select * from invitations where id = $id";
    include_once __DIR__.'/../mysqli_single_object.php';
    return mysqli_single_object($mysqli, $sql);
}
