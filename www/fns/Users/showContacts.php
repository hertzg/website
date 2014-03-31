<?php

namespace Users;

function showContacts ($mysqli, $id_users, $show) {
    $show_contacts = $show ? '1' : '0';
    $mysqli->query(
        "update users set show_contacts = $show_contacts"
        ." where id_users = $id_users"
    );
}
