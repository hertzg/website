<?php

namespace TaskRevisions;

function indexOnTask ($mysqli, $id_tasks) {
    $sql = 'select * from task_revisions'
        ." where id_tasks = $id_tasks order by insert_time desc";
    include_once __DIR__.'/../mysqli_query_object.php';
    return mysqli_query_object($mysqli, $sql);
}
