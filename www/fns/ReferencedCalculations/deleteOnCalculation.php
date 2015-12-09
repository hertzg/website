<?php

namespace ReferencedCalculations;

function deleteOnCalculation ($mysqli, $id_calculations) {
    $sql = 'delete from referenced_calculations'
        ." where id_calculations = $id_calculations";
    $mysqli->query($sql) || trigger_error($mysqli->error);
}
