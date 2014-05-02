<?php

namespace Schedules;

function deleteOnUser ($mysqli, $id_users) {
    $sql = "delete from schedules where id_users = $id_users";
    $mysqli->query($sql) || trigger_error($mysqli->error);
}
