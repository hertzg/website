<?php

namespace Users\Birthdays;

function setNumbers ($mysqli, $id_users, $num_birthdays_today,
    $num_birthdays_tomorrow, $birthdays_check_day) {

    $sql = "update users set num_birthdays_today = $num_birthdays_today,"
        ." num_birthdays_tomorrow = $num_birthdays_tomorrow,"
        ." birthdays_check_day = $birthdays_check_day"
        ." where id_users = $id_users";
    $mysqli->query($sql) || trigger_error($mysqli->error);

}
