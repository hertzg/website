<?php

namespace TaskTags;

function setTaskDone ($mysqli, $idtasks, $done) {
    $done = $done ? '1' : '0';
    $sql = "update tasktags set done = $done where idtasks = $idtasks";
    mysqli_query($mysqli, $sql);
}
