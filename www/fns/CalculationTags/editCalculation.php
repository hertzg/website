<?php

namespace CalculationTags;

function editCalculation ($mysqli, $id_calculations,
    $expression, $title, $insert_time, $update_time) {

    $title = $mysqli->real_escape_string($title);
    $expression = $mysqli->real_escape_string($expression);

    $sql = 'update calculation_tags set'
        ." title = '$title', expression = '$expression',"
        ." insert_time = $insert_time, update_time = $update_time"
        ." where id_calculations = $id_calculations";

    $mysqli->query($sql) || trigger_error($mysqli->error);

}
