<?php

namespace Users\Contacts;

function editOrderBy ($mysqli, $id, $contacts_order_by) {
    $sql = "update users set contacts_order_by = '$contacts_order_by'"
        ." where id_users = $id";
    $mysqli->query($sql) || trigger_error($mysqli->error);
}
