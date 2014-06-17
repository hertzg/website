<?php

namespace Users\DeletedItems;

function addNumber ($mysqli, $id_users, $n) {
    $sql = "update users set num_deleted_items = num_deleted_items + $n"
        ." where id_users = $id_users";
    $mysqli->query($sql) || trigger_error($mysqli->error);
}
