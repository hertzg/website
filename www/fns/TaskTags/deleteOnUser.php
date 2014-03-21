<?php

namespace TaskTags;

function deleteOnUser ($mysqli, $idusers) {
    $mysqli->query("delete from task_tags where idusers = $idusers");
}
