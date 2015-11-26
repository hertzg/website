<?php

namespace SendingTasks;

function increaseNumFails ($mysqli, $id) {
    $sql = 'update sending_tasks set'
        ." num_fails = num_fails + 1 where id = $id";
    $mysqli->query($sql) || trigger_error($mysqli->error);
}
