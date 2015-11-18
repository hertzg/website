<?php

namespace ReceivedSchedules;

function delete ($mysqli, $id) {
    $sql = "delete from received_schedules where id = $id";
    $mysqli->query($sql) || trigger_error($mysqli->error);
}
