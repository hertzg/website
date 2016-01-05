<?php

namespace CalculationTags;

function editValue ($mysqli, $id, $value) {
    if ($value === null) $value = 'null';
    $sql = "update calculation_tags set value = $value"
        ." where id_calculations = $id";
    $mysqli->query($sql) || trigger_error($mysqli->error);
}
