<?php

namespace Users\Contacts\Received;

function addNumberNew ($mysqli, $id_users, $n) {
    $sql = 'update users set'
        ." num_received_contacts = num_received_contacts + $n,"
        ." home_num_new_received_contacts = home_num_new_received_contacts + $n"
        ." where id_users = $id_users";
    $mysqli->query($sql) || trigger_error($mysqli->error);
}
