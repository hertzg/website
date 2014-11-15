<?php

namespace Contacts;

function indexOnUserInBirthdayRanges ($mysqli, $id_users, $ranges) {

    $sql = "select * from contacts where id_users = $id_users and (1";
    foreach ($ranges as $range) {
        $from = $range['from'];
        $to = $range['to'];
        $sql .= " or (birthday_day between $from[day] and $to[day]"
            ." and birthday_month between $from[month] and $to[month])";
    }
    $sql .= ')';

    include_once __DIR__.'/../mysqli_query_object.php';
    return mysqli_query_object($mysqli, $sql);

}
