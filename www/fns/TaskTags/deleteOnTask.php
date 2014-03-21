<?php

namespace TaskTags;

function deleteOnTask ($mysqli, $idtasks) {
    $mysqli->query("delete from task_tags where idtasks = $idtasks");
}
