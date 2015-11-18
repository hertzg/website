<?php

namespace SendingSchedules;

function delete ($mysqli, $id) {
    $sql = "delete from sending_schedules where id = $id";
    $mysqli->query($sql) || trigger_error($mysqli->error);
}
