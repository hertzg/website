<?php

namespace Users;

function showFiles ($mysqli, $id_users, $show) {
    $show_files = $show ? '1' : '0';
    $mysqli->query(
        "update users set show_files = $show_files"
        ." where id_users = $id_users"
    );
}
