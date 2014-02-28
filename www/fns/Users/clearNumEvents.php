<?php

namespace Users;

function clearNumEvents ($mysqli, $idusers) {
    $sql = "update users set num_events = 0 where idusers = $idusers";
    $mysqli->query($sql);
}
