<?php

namespace Events;

function deleteOnUser ($mysqli, $idusers) {
    $mysqli->query("delete from events where idusers = $idusers");
}
