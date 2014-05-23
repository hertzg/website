<?php

namespace Contacts;

function deleteOnUser ($mysqli, $id_users) {
    $sql = "delete from contacts where id_users = $id_users";
    $mysqli->query($sql) || trigger_error($mysqli->error);
}
