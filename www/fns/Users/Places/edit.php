<?php

namespace Users\Places;

function edit ($mysqli, $place, $latitude, $longitude,
    $name, $tags, $tag_names, $updateApiKey = null) {

    $id = $place->id;
    $fnsDir = __DIR__.'/../..';

    include_once "$fnsDir/Places/edit.php";
    \Places\edit($mysqli, $id, $latitude, $longitude,
        $name, $tags, $tag_names, $updateApiKey);

    if ($place->num_tags) {
        include_once "$fnsDir/PlaceTags/deleteOnPlace.php";
        \PlaceTags\deleteOnPlace($mysqli, $id);
    }

    if ($tag_names) {
        include_once "$fnsDir/PlaceTags/add.php";
        \PlaceTags\add($mysqli, $place->id_users, $id,
            $tag_names, $latitude, $longitude, $name, $tags);
    }

}
