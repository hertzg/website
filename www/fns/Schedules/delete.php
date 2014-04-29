<?php

namespace Schedules;

function delete ($mysqli, $id) {
    $sql = "delete from schedules where id = $id";
    $mysqli->query($sql) || trigger_error($mysqli->error);
}
