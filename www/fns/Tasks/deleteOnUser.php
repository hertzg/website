<?php

namespace Tasks;

function deleteOnUser ($mysqli, $idusers) {
    $mysqli->query("delete from tasks where idusers = $idusers");
}
