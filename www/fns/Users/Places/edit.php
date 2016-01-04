<?php

namespace Users\Places;

function edit ($mysqli, $place, $latitude, $longitude, $altitude,
    $name, $description, $tags, $tag_names, &$changed, $updateApiKey = null) {

    $tags_same = $place->tags === $tags;

    if ($place->name === $name &&
        (string)$place->latitude === (string)$latitude &&
        (string)$place->longitude === (string)$longitude) {

        if (($place->altitude === null && $altitude === null) ||
            (string)$place->altitude === (string)$altitude) {

            if ($place->description === $description && $tags_same) return;

        }

    }

    $changed = true;
    $id = $place->id;
    $fnsDir = __DIR__.'/../..';

    if ((string)$latitude !== $place->latitude ||
        (string)$longitude !== $place->longitude ||
        (string)$altitude !== $place->altitude) {

        include_once "$fnsDir/PlacePoints/deleteOnPlace.php";
        \PlacePoints\deleteOnPlace($mysqli, $id);

        include_once "$fnsDir/PlacePoints/add.php";
        \PlacePoints\add($mysqli, $place->id_users,
            $id, $latitude, $longitude, $altitude, $updateApiKey);

        $num_points = 1;

    } else {
        $num_points = $place->num_points;
    }

    $update_time = time();

    include_once "$fnsDir/Places/edit.php";
    \Places\edit($mysqli, $id, $latitude,
        $longitude, $altitude, $name, $description, $tags,
        $tag_names, $num_points, $update_time, $updateApiKey);

    if ($tags_same) {
        if ($tag_names) {
            include_once "$fnsDir/PlaceTags/editPlace.php";
            \PlaceTags\editPlace($mysqli, $id, $latitude,
                $longitude, $name, $description, $tags, $tag_names,
                $place->insert_time, $update_time);
        }
    } else {

        if ($place->num_tags) {
            include_once "$fnsDir/PlaceTags/deleteOnPlace.php";
            \PlaceTags\deleteOnPlace($mysqli, $id);
        }

        if ($tag_names) {
            include_once "$fnsDir/PlaceTags/add.php";
            \PlaceTags\add($mysqli, $place->id_users, $id,
                $tag_names, $latitude, $longitude, $name,
                $description, $tags, $place->insert_time, $update_time);
        }

    }

}
