<?php

namespace Contacts;

function get ($mysqli, $idusers, $id) {
    $sql = 'select * from contacts'
        ." where idusers = $idusers and idcontacts = $id";
    include_once __DIR__.'/../mysqli_single_object.php';
    return mysqli_single_object($mysqli, $sql);
}
