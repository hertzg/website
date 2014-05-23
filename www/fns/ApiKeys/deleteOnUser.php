<?php

namespace ApiKeys;

function deleteOnUser ($mysqli, $id_users) {
    $sql = "delete from api_keys where id_users = $id_users";
    $mysqli->query($sql) || trigger_error($mysqli->error);
}
