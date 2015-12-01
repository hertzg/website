<?php

namespace CalculationTags;

function editCalculation ($mysqli, $id_calculations,
    $url, $title, $insert_time, $update_time) {

    $title = $mysqli->real_escape_string($title);
    $url = $mysqli->real_escape_string($url);

    $sql = "update calculation_tags set title = '$title', url = '$url',"
        ." insert_time = $insert_time, update_time = $update_time"
        ." where id_calculations = $id_calculations";

    $mysqli->query($sql) || trigger_error($mysqli->error);

}
