<?php

namespace Wallets;

function getOnUser ($mysqli, $id_users, $id) {
    $sql = "select * from wallets where id_users = $id_users and id = $id";
    include_once __DIR__.'/../mysqli_single_object.php';
    return mysqli_single_object($mysqli, $sql);
}