<?php

namespace Users;

function showNewBookmark ($mysqli, $id_users, $show) {
    $show_new_bookmark = $show ? '1' : '0';
    $mysqli->query(
        "update users set show_new_bookmark = $show_new_bookmark"
        ." where id_users = $id_users"
    );
}
