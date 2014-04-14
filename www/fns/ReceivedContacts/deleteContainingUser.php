<?php

namespace ReceivedContacts;

function deleteContainingUser ($mysqli, $id_users) {
    $sql = 'delete from received_contacts'
        ." where receiver_id_users = $id_users"
        ." or sender_id_users = $id_users";
    $mysqli->query($sql) || trigger_error($mysqli);
}
