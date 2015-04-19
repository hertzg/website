<?php

namespace PlacePoints;

function setDeletedOnPlace ($mysqli, $id_places, $deleted) {
    $deleted = $deleted ? '1' : '0';
    $sql = "update place_points set deleted = $deleted"
        ." where id_places = $id_places";
    $mysqli->query($sql) || trigger_error($mysqli->error);
}
