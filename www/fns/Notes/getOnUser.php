<?php

namespace Notes;

function getOnUser ($mysqli, $id_users, $id) {
    $sql = "select * from notes where id = $id";
    include_once __DIR__.'/../mysqli_single_object.php';
    $note = mysqli_single_object($mysqli, $sql);
    if ($note && $note->id_users == $id_users) return $note;
}
