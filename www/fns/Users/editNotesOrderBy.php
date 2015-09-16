<?php

namespace Users;

function editNotesOrderBy ($mysqli, $id, $notes_order_by) {
    $sql = "update users set notes_order_by = '$notes_order_by'"
        ." where id_users = $id";
    $mysqli->query($sql) || trigger_error($mysqli->error);
}
