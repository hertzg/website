<?php

namespace CalculationTags;

function editCalculation ($mysqli, $id_calculations,
    $expression, $title, $tag_names, $value, $insert_time, $update_time) {

    $title = $mysqli->real_escape_string($title);
    $expression = $mysqli->real_escape_string($expression);
    $tags_json = $mysqli->real_escape_string(json_encode($tag_names));
    if ($value === null) $value = 'null';

    $sql = "update calculation_tags set title = '$title',"
        ." expression = '$expression', tags_json = '$tags_json',"
        ." value = $value, insert_time = $insert_time,"
        ." update_time = $update_time where id_calculations = $id_calculations";

    $mysqli->query($sql) || trigger_error($mysqli->error);

}
