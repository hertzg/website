<?php

namespace CalculationDepends;

function indexOnDependCalculation ($mysqli, $depend_id_calculations) {
    $sql = 'select * from calculation_depends'
        ." where depend_id_calculations = $depend_id_calculations";
    include_once __DIR__.'/../mysqli_query_object.php';
    return mysqli_query_object($mysqli, $sql);
}
