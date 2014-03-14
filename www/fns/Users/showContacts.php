<?php

namespace Users;

function showContacts ($mysqli, $idusers, $show) {
    $show_contacts = $show ? '1' : '0';
    $mysqli->query(
        "update users set show_contacts = $show_contacts"
        ." where idusers = $idusers"
    );
}
