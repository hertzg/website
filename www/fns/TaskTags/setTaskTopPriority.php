<?php

namespace TaskTags;

function setTaskTopPriority ($mysqli, $id_tasks, $top_priority) {
    $top_priority = $top_priority ? '1' : '0';
    $sql = "update task_tags set top_priority = $top_priority"
        ." where id_tasks = $id_tasks";
    $mysqli->query($sql);
}
