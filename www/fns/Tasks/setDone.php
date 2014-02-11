<?php

namespace Tasks;

function setDone ($mysqli, $idusers, $id, $done) {
    $done = $done ? '1' : '0';
    $updatetime = time();
    $sql = "update tasks set done = $done, updatetime = $updatetime"
        ." where idusers = $idusers and idtasks = $id";
    mysqli_query($mysqli, $sql);
}
