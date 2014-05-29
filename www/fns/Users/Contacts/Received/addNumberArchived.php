<?php

namespace Users\Contacts\Received;

function addNumberArchived ($mysqli, $id_users, $n) {
    $sql = 'update users set num_archived_received_contacts ='
        ." num_archived_received_contacts + $n"
        ." where id_users = $id_users";
    $mysqli->query($sql) || trigger_error($mysqli);
}
