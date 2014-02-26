<?php

namespace TaskTags;

function setTaskTopPriority ($mysqli, $idtasks, $top_priority) {
    $top_priority = $top_priority ? '1' : '0';
    $sql = "update tasktags set top_priority = $top_priority where idtasks = $idtasks";
    mysqli_query($mysqli, $sql);
}
