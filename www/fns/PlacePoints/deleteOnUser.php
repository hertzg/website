<?php

namespace PlacePoints;

function deleteOnUser ($mysqli, $id_users) {
    $sql = "delete from place_points where id_users = $id_users";
    $mysqli->query($sql) || trigger_error($mysqli->error);
}
