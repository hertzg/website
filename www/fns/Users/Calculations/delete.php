<?php

namespace Users\Calculations;

function delete ($mysqli, $calculation, $apiKey = null) {

    $id = $calculation->id;
    $fnsDir = __DIR__.'/../..';

    include_once "$fnsDir/Calculations/delete.php";
    \Calculations\delete($mysqli, $id);

    if ($calculation->num_tags) {
        include_once "$fnsDir/CalculationTags/deleteOnCalculation.php";
        \CalculationTags\deleteOnCalculation($mysqli, $id);
    }

    include_once __DIR__.'/addNumber.php';
    addNumber($mysqli, $calculation->id_users, -1);

    include_once __DIR__.'/../DeletedItems/addCalculation.php';
    \Users\DeletedItems\addCalculation($mysqli, $calculation, $apiKey);

}
