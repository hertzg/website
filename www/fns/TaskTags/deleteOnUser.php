<?php

namespace TaskTags;

function deleteOnUser ($mysqli, $idusers) {
    $mysqli->query("delete from tasktags where idusers = $idusers");
}
