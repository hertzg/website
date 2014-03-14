<?php

namespace Users;

function showNewBookmark ($mysqli, $idusers, $show) {
    $show_new_bookmark = $show ? '1' : '0';
    $mysqli->query(
        "update users set show_new_bookmark = $show_new_bookmark"
        ." where idusers = $idusers"
    );
}
