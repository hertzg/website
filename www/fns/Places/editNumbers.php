<?php

namespace Places;

function editNumbers ($mysqli, $id, $num_points) {
    $sql = "update places set num_points = $num_points where id = $id";
    $mysqli->query($sql) || trigger_error($mysqli->error);
}
