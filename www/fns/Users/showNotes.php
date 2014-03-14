<?php

namespace Users;

function showNotes ($mysqli, $idusers, $show) {
    $show_notes = $show ? '1' : '0';
    $mysqli->query(
        "update users set show_notes = $show_notes"
        ." where idusers = $idusers"
    );
}
