<?php

namespace ReceivedPlaces;

function setArchived ($mysqli, $id, $archived) {
    $archived = $archived ? '1' : '0';
    $sql = "update received_places set archived = $archived where id = $id";
    $mysqli->query($sql) || trigger_error($mysqli->error);
}
