<?php

namespace PlacePoints;

function delete ($mysqli, $id) {
    $sql = "delete from place_points where id = $id";
    $mysqli->query($sql) || trigger_error($mysqli->error);
}
