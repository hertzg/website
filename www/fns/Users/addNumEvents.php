<?php

namespace Users;

function addNumEvents ($mysqli, $idusers, $num_events) {
    $sql = "update users set num_events = num_events + $num_events"
        ." where idusers = $idusers";
    $mysqli->query($sql);
}
