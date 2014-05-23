<?php

namespace Contacts;

function delete ($mysqli, $id) {
    $sql = "delete from contacts where id_contacts = $id";
    $mysqli->query($sql) || trigger_error($mysqli->error);
}
