<?php

namespace Tasks;

function delete ($mysqli, $id) {
    $sql = "delete from tasks where id_tasks = $id";
    $mysqli->query($sql) || trigger_error($mysqli->error);
}
