<?php

namespace Calculations;

function getOnUser ($mysqli, $id_users, $id) {
    $sql = "select * from calculations where id = $id";
    include_once __DIR__.'/../mysqli_single_object.php';
    $calculation = mysqli_single_object($mysqli, $sql);
    if ($calculation && $calculation->id_users == $id_users) return $calculation;
}
