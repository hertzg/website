<?php

namespace Contacts;

function getOnUser ($mysqli, $id_users, $id) {
    $sql = "select * from contacts where id = $id";
    include_once __DIR__.'/../mysqli_single_object.php';
    $contact = mysqli_single_object($mysqli, $sql);
    if ($contact && $contact->id_users == $id_users) return $contact;
}
