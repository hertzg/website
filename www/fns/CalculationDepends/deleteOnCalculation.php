<?php

namespace CalculationDepends;

function deleteOnCalculation ($mysqli, $id_calculations) {
    $sql = 'delete from calculation_depends'
        ." where id_calculations = $id_calculations";
    $mysqli->query($sql) || trigger_error($mysqli->error);
}
