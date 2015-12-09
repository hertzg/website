<?php

namespace ReferencedCalculations;

function indexOnReferencedCalculation ($mysqli, $referenced_id_calculations) {
    $sql = 'select * from referenced_calculations'
        ." where referenced_id_calculations = $referenced_id_calculations";
    include_once __DIR__.'/../mysqli_query_object.php';
    return mysqli_query_object($mysqli, $sql);
}
