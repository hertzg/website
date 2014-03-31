<?php

namespace Users;

function showNotes ($mysqli, $id_users, $show) {
    $show_notes = $show ? '1' : '0';
    $mysqli->query(
        "update users set show_notes = $show_notes"
        ." where id_users = $id_users"
    );
}
