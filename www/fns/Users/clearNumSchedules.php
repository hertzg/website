<?php

namespace Users;

function clearNumSchedules ($mysqli, $id_users) {
    $sql = "update users set num_schedules = 0 where id_users = $id_users";
    $mysqli->query($sql);
}
