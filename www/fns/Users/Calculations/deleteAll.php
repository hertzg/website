<?php

namespace Users\Calculations;

function deleteAll ($mysqli, $user, $apiKey = null) {

    if (!$user->num_calculations) return;

    $id_users = $user->id_users;
    $fnsDir = __DIR__.'/../..';

    include_once "$fnsDir/Calculations/indexOnUser.php";
    $calculations = \Calculations\indexOnUser($mysqli, $id_users);

    if ($calculations) {
        include_once __DIR__.'/../DeletedItems/addCalculation.php';
        foreach ($calculations as $calculation) {
            \Users\DeletedItems\addCalculation($mysqli, $calculation, $apiKey);
        }
    }

    include_once "$fnsDir/Calculations/deleteOnUser.php";
    \Calculations\deleteOnUser($mysqli, $id_users);

    include_once "$fnsDir/CalculationTags/deleteOnUser.php";
    \CalculationTags\deleteOnUser($mysqli, $id_users);

    $sql = "update users set num_calculations = 0 where id_users = $id_users";
    $mysqli->query($sql) || trigger_error($mysqli->error);

}
