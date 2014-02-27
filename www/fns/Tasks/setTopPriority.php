<?php

namespace Tasks;

function setTopPriority ($mysqli, $idusers, $id, $top_priority) {
    $top_priority = $top_priority ? '1' : '0';
    $updatetime = time();
    $sql = "update tasks set top_priority = $top_priority,"
        ." updatetime = $updatetime"
        ." where idusers = $idusers and idtasks = $id";
    $mysqli->query($sql);
}
