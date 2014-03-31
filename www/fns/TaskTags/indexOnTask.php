<?php

namespace TaskTags;

function indexOnTask ($mysqli, $id_tasks) {
    $sql = 'select * from task_tags'
        ." where id_tasks = $id_tasks order by tag_name";
    include_once __DIR__.'/../mysqli_query_object.php';
    return mysqli_query_object($mysqli, $sql);
}
