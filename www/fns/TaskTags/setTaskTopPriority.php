<?php

namespace TaskTags;

function setTaskTopPriority ($mysqli, $idtasks, $top_priority) {
    $top_priority = $top_priority ? '1' : '0';
    $sql = "update task_tags set top_priority = $top_priority"
        ." where idtasks = $idtasks";
    $mysqli->query($sql);
}
