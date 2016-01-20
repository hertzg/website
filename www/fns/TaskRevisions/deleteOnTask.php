<?php

namespace TaskRevisions;

function deleteOnTask ($mysqli, $id_tasks) {
    $sql = "delete from task_revisions where id_tasks = $id_tasks";
    $mysqli->query($sql) || trigger_error($mysqli->error);
}
