<?php

namespace Users;

function showNewContact ($mysqli, $idusers, $show) {
    $show_new_contact = $show ? '1' : '0';
    $mysqli->query(
        "update users set show_new_contact = $show_new_contact"
        ." where idusers = $idusers"
    );
}
