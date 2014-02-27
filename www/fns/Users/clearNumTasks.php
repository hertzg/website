<?php

namespace Users;

function clearNumTasks ($mysqli, $idusers) {
    $sql = "update users set num_tasks = 0 where idusers = $idusers";
    $mysqli->query($sql);
}
