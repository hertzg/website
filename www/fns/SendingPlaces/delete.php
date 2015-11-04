<?php

namespace SendingPlaces;

function delete ($mysqli, $id) {
    $sql = "delete from sending_places where id = $id";
    $mysqli->query($sql) || trigger_error($mysqli->error);
}
