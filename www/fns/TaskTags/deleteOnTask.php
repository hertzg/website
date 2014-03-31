<?php

namespace TaskTags;

function deleteOnTask ($mysqli, $id_tasks) {
    $mysqli->query("delete from task_tags where id_tasks = $id_tasks");
}
