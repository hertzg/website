<?php

namespace Contacts;

function deleteOnUser ($mysqli, $id_users) {
    $mysqli->query("delete from contacts where id_users = $id_users");
}
