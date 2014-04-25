<?php

namespace Contacts;

function getOnUser ($mysqli, $id_users, $id) {
    $sql = 'select * from contacts'
        ." where id_users = $id_users and id_contacts = $id";
    include_once __DIR__.'/../mysqli_single_object.php';
    return mysqli_single_object($mysqli, $sql);
}
