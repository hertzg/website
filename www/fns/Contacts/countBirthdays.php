<?php

namespace Contacts;

function countBirthdays ($mysqli, $day, $month) {
    $sql = 'select count(*) value from contacts'
        ." where birthday_day = $day and birthday_month = $month";
    include_once __DIR__.'/../mysqli_single_object.php';
    return mysqli_single_object($mysqli, $sql)->value;
}
