<?php

namespace Users;

function showCalendar ($mysqli, $id_users, $show) {
    $show_calendar = $show ? '1' : '0';
    $mysqli->query(
        "update users set show_calendar = $show_calendar"
        ." where id_users = $id_users"
    );
}
