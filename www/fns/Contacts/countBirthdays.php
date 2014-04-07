<?php

namespace Contacts;

function countBirthdays ($mysqli, $id_users, $day, $month) {
    $sql = "select count(*) value from contacts where id_users = $id_users"
        ." and birthday_day = $day and birthday_month = $month";
    include_once __DIR__.'/../mysqli_single_object.php';
    return mysqli_single_object($mysqli, $sql)->value;
}
