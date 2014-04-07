<?php

namespace Contacts;

function countBirthDays ($mysqli, $id_users, $day, $month) {
    $sql = "select count(*) value from contacts where id_users = $id_users"
        ." and birth_day = $day and birth_month = $month";
    include_once __DIR__.'/../mysqli_single_object.php';
    return mysqli_single_object($mysqli, $sql)->value;
}
