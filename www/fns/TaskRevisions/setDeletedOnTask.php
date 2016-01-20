<?php

namespace TaskRevisions;

function setDeletedOnTask ($mysqli, $id_tasks, $deleted) {
    $deleted = $deleted ? '1' : '0';
    $sql = "update task_revisions set deleted = $deleted"
        ." where id_tasks = $id_tasks";
    $mysqli->query($sql) || trigger_error($mysqli->error);
}
