<?php

namespace CalculationTags;

function deleteOnCalculation ($mysqli, $id_calculations) {
    $sql = 'delete from calculation_tags'
        ." where id_calculations = $id_calculations";
    $mysqli->query($sql) || trigger_error($mysqli->error);
}
