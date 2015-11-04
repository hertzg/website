<?php

namespace SendingContacts;

function delete ($mysqli, $id) {
    $sql = "delete from sending_contacts where id = $id";
    $mysqli->query($sql) || trigger_error($mysqli->error);
}
