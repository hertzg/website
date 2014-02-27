<?php

namespace Users;

function clearNumContacts ($mysqli, $idusers) {
    $sql = "update users set num_contacts = 0 where idusers = $idusers";
    $mysqli->query($sql);
}
