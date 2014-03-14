<?php

namespace Users;

function showNewNote ($mysqli, $idusers, $show) {
    $show_new_note = $show ? '1' : '0';
    $mysqli->query(
        "update users set show_new_note = $show_new_note"
        ." where idusers = $idusers"
    );
}
