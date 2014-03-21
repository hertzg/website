<?php

namespace Tasks;

function setTopPriority ($mysqli, $idusers, $id, $top_priority) {
    $top_priority = $top_priority ? '1' : '0';
    $update_time = time();
    $sql = "update tasks set top_priority = $top_priority,"
        ." update_time = $update_time"
        ." where idusers = $idusers and idtasks = $id";
    $mysqli->query($sql);
}
