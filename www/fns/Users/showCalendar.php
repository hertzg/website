<?php

namespace Users;

function showCalendar ($mysqli, $idusers, $show) {
    $show_calendar = $show ? '1' : '0';
    $mysqli->query(
        "update users set show_calendar = $show_calendar"
        ." where idusers = $idusers"
    );
}
