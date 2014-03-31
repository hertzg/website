<?php

namespace Users;

function clearNumContacts ($mysqli, $id_users) {
    $sql = "update users set num_contacts = 0 where id_users = $id_users";
    $mysqli->query($sql);
}
