<?php

namespace Users;

function showNewTask ($mysqli, $id_users, $show) {
    $show_new_task = $show ? '1' : '0';
    $mysqli->query(
        "update users set show_new_task = $show_new_task"
        ." where id_users = $id_users"
    );
}
