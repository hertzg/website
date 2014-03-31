<?php

namespace Users;

function showNewNote ($mysqli, $id_users, $show) {
    $show_new_note = $show ? '1' : '0';
    $mysqli->query(
        "update users set show_new_note = $show_new_note"
        ." where id_users = $id_users"
    );
}
