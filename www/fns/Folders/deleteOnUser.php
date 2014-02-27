<?php

namespace Folders;

function deleteOnUser ($mysqli, $idusers) {
    $mysqli->query("delete from folders where idusers = $idusers");
}
