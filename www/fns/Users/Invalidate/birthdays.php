<?php

namespace Users\Invalidate;

function birthdays ($mysqli, $id_users) {
    $sql = 'update users set birthdays_check_day = 0, num_birthdays_today = 0,'
        ." num_birthdays_tomorrow = 0 where id_users = $id_users";
    $mysqli->query($sql) || trigger_error($mysqli->error);
}
