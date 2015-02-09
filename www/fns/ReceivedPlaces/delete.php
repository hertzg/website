<?php

namespace ReceivedPlaces;

function delete ($mysqli, $id) {
    $sql = "delete from received_places where id = $id";
    $mysqli->query($sql) || trigger_error($mysqli->error);
}
