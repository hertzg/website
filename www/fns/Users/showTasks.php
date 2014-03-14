<?php

namespace Users;

function showTasks ($mysqli, $idusers, $show) {
    $show_tasks = $show ? '1' : '0';
    $mysqli->query(
        "update users set show_tasks = $show_tasks"
        ." where idusers = $idusers"
    );
}
