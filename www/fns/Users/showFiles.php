<?php

namespace Users;

function showFiles ($mysqli, $idusers, $show) {
    $show_files = $show ? '1' : '0';
    $mysqli->query(
        "update users set show_files = $show_files"
        ." where idusers = $idusers"
    );
}
