<?php

namespace Users;

function getByEmail ($mysqli, $email, $excludeidusers = 0) {
    $email = mysqli_real_escape_string($mysqli, $email);
    $sql = 'select * from users'
        ." where email = '$email' and idusers != $excludeidusers";
    include_once __DIR__.'/../mysqli_single_object.php';
    return mysqli_single_object($mysqli, $sql);
}
