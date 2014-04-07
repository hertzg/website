<?php

namespace Contacts;

function indexBirthDays ($mysqli, $day, $month) {
    $sql = 'select * from contacts'
        ." where birth_day = $day and birth_month = $month";
    include_once __DIR__.'/../mysqli_query_object.php';
    return mysqli_query_object($mysqli, $sql);
}
