<?php

namespace DeletedItems;

function delete ($mysqli, $id) {
    $sql = "delete from deleted_items where id = $id";
    $mysqli->query($sql) || trigger_error($mysqli->error);
}
