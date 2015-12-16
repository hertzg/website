<?php

namespace CalculationDepends;

function indexOnCalculation ($mysqli, $id_calculations) {
    $sql = 'select * from calculation_depends'
        ." where id_calculations = $id_calculations";
    include_once __DIR__.'/../mysqli_query_object.php';
    return mysqli_query_object($mysqli, $sql);
}
