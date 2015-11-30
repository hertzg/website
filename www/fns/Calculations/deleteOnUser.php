<?php

namespace Calculations;

function deleteOnUser ($mysqli, $id_users) {
    $sql = "delete from calculations where id_users = $id_users";
    $mysqli->query($sql) || trigger_error($mysqli->error);
}
