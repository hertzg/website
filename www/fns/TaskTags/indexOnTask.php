<?php

namespace TaskTags;

function indexOnTask ($mysqli, $idtasks) {
    $sql = 'select * from task_tags'
        ." where idtasks = $idtasks order by tagname";
    include_once __DIR__.'/../mysqli_query_object.php';
    return mysqli_query_object($mysqli, $sql);
}
