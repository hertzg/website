<?php

namespace Users;

function addNumContacts ($mysqli, $id_users, $num_contacts) {
    $sql = "update users set num_contacts = num_contacts + $num_contacts"
        ." where id_users = $id_users";
    $mysqli->query($sql);
}
