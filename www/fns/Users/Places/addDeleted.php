<?php

namespace Users\Places;

function addDeleted ($mysqli, $id_users, $data) {

    $id = $data->id;
    $latitude = $data->latitude;
    $longitude = $data->longitude;
    $name = $data->name;
    $description = $data->description;
    $tags = $data->tags;

    $fnsDir = __DIR__.'/../..';

    include_once "$fnsDir/Tags/parse.php";
    $tag_names = \Tags\parse($tags);

    include_once "$fnsDir/Places/addDeleted.php";
    \Places\addDeleted($mysqli, $id, $id_users, $latitude,
        $longitude, $data->altitude, $name, $description,
        $tags, $tag_names, $data->num_points, $data->insert_time,
        $data->update_time, $data->revision);

    include_once "$fnsDir/PlacePoints/setDeletedOnPlace.php";
    \PlacePoints\setDeletedOnPlace($mysqli, $id, false);

    if ($tag_names) {
        include_once "$fnsDir/PlaceTags/add.php";
        \PlaceTags\add($mysqli, $id_users, $id, $tag_names,
            $latitude, $longitude, $name, $description, $tags);
    }

    include_once __DIR__.'/addNumber.php';
    addNumber($mysqli, $id_users, 1);

}
