<?php

namespace Users;

function clearNumEvents ($mysqli, $id_users) {
    $sql = "update users set num_events = 0 where id_users = $id_users";
    $mysqli->query($sql);
}
