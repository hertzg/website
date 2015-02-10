<?php

namespace PlaceTags;

function deleteOnPlace ($mysqli, $id_places) {
    $sql = "delete from place_tags where id_places = $id_places";
    $mysqli->query($sql) || trigger_error($mysqli->error);
}
