<?php

namespace TaskTags;

function deleteOnTask ($mysqli, $idtasks) {
    $mysqli->query("delete from tasktags where idtasks = $idtasks");
}
