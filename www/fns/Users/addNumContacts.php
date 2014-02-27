<?php

namespace Users;

function addNumContacts ($mysqli, $idusers, $num_contacts) {
    $sql = "update users set num_contacts = num_contacts + $num_contacts"
        ." where idusers = $idusers";
    $mysqli->query($sql);
}
