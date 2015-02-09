<?php

namespace Users\Places;

function add ($mysqli, $id_users, $latitude, $longitude,
    $name, $tags, $tag_names, $insertApiKey = null) {

    $fnsDir = __DIR__.'/../..';

    include_once "$fnsDir/Places/add.php";
    $id = \Places\add($mysqli, $id_users, $latitude,
        $longitude, $name, $tags, $tag_names, $insertApiKey);

    if ($tag_names) {
        include_once "$fnsDir/PlaceTags/add.php";
        \PlaceTags\add($mysqli, $id_users, $id,
            $tag_names, $latitude, $longitude, $name, $tags);
    }

    include_once __DIR__.'/addNumber.php';
    addNumber($mysqli, $id_users, 1);

    return $id;

}
