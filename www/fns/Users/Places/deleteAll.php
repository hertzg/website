<?php

namespace Users\Places;

function deleteAll ($mysqli, $id_users, $apiKey = null) {

    $fnsDir = __DIR__.'/../..';

    include_once "$fnsDir/Places/indexOnUser.php";
    $places = \Places\indexOnUser($mysqli, $id_users);

    if ($places) {
        include_once __DIR__.'/../DeletedItems/addPlace.php';
        foreach ($places as $place) {
            \Users\DeletedItems\addPlace($mysqli, $place, $apiKey);
        }
    }

    include_once "$fnsDir/Places/deleteOnUser.php";
    \Places\deleteOnUser($mysqli, $id_users);

    include_once "$fnsDir/PlaceTags/deleteOnUser.php";
    \PlaceTags\deleteOnUser($mysqli, $id_users);

    $sql = "update users set num_places = 0 where id_users = $id_users";
    $mysqli->query($sql) || trigger_error($mysqli->error);

}
