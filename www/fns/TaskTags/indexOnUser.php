<?php

namespace TaskTags;

function indexOnUser ($mysqli, $id_users) {
    $sql = 'select tag_name, count(*) num_items from task_tags'
        ." where id_users = $id_users group by tag_name order by tag_name";
    include_once __DIR__.'/../mysqli_query_object.php';
    return mysqli_query_object($mysqli, $sql);
}
