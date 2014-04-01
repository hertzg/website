<?php

namespace ReceivedContacts;

function delete ($mysqli, $id) {
    $sql = "delete from received_contacts where id = $id";
    $mysqli->query($sql) || trigger_error($mysqli->error);
}
