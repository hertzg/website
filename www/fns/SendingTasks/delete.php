<?php

namespace SendingTasks;

function delete ($mysqli, $id) {
    $sql = "delete from sending_tasks where id = $id";
    $mysqli->query($sql) || trigger_error($mysqli->error);
}
