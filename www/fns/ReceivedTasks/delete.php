<?php

namespace ReceivedTasks;

function delete ($mysqli, $id) {
    $sql = "delete from received_tasks where id = $id";
    $mysqli->query($sql) || trigger_error($mysqli->error);
}
