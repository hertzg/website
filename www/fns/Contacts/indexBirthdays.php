<?php

namespace Contacts;

function indexBirthdays ($mysqli, $id_users, $day, $month) {
    $sql = "select * from contacts where id_users = $id_users"
        ." and birthday_day = $day and birthday_month = $month";
    include_once __DIR__.'/../mysqli_query_object.php';
    return mysqli_query_object($mysqli, $sql);
}
