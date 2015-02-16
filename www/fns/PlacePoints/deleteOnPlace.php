<?php

namespace PlacePoints;

function deleteOnPlace ($mysqli, $id_places) {
    $sql = "delete from place_points where id_places = $id_places";
    $mysqli->query($sql) || trigger_error($mysqli->error);
}
