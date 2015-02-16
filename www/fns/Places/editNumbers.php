<?php

namespace Places;

function editNumbers ($mysqli, $id, $num_place_points) {
    $sql = 'update places set'
        ." num_place_points = $num_place_points where id = $id";
    $mysqli->query($sql) || trigger_error($mysqli->error);
}
