<?php

namespace Users;

function showTasks ($mysqli, $id_users, $show) {
    $show_tasks = $show ? '1' : '0';
    $mysqli->query(
        "update users set show_tasks = $show_tasks"
        ." where id_users = $id_users"
    );
}
