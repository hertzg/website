<?php

namespace PlacePoints;

function setDeletedOnUser ($mysqli, $id_users) {
    $sql = "update place_points set deleted = 1 where id_users = $id_users";
    $mysqli->query($sql) || trigger_error($mysqli->error);
}
