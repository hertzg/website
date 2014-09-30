<?php

namespace DeletedItems;

function getOnUser ($mysqli, $id_users, $id) {
    $sql = "select * from deleted_items where id = $id";
    include_once __DIR__.'/../mysqli_single_object.php';
    $item = mysqli_single_object($mysqli, $sql);
    if ($item && $item->id_users == $id_users) return $item;
}
