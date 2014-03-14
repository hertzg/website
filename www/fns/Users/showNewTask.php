<?php

namespace Users;

function showNewTask ($mysqli, $idusers, $show) {
    $show_new_task = $show ? '1' : '0';
    $mysqli->query(
        "update users set show_new_task = $show_new_task"
        ." where idusers = $idusers"
    );
}
