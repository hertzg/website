<?php

namespace TaskTags;

function deleteOnTask ($mysqli, $id_tasks) {
    $sql = "delete from task_tags where id_tasks = $id_tasks";
    $mysqli->query($sql) || trigger_error($mysqli->error);
}
