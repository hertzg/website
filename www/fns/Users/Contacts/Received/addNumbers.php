<?php

namespace Users\Contacts\Received;

function addNumbers ($mysqli, $id_users, $num, $num_archived) {
    $sql = 'update users set'
        ." num_received_contacts = num_received_contacts + $num,"
        .' num_archived_received_contacts'
        ." = num_archived_received_contacts + $num_archived"
        ." where id_users = $id_users";
    $mysqli->query($sql) || trigger_error($mysqli->error);
}
