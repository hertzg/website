<?php

namespace Users;

function addNumReceivedContacts ($mysqli, $id_users, $n) {
    $sql = 'update users set'
        ." num_received_contacts = num_received_contacts + $n"
        ." where id_users = $id_users";
    $mysqli->query($sql) || trigger_error($mysqli->error);
}
