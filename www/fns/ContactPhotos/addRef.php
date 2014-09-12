<?php

namespace ContactPhotos;

function addRef ($mysqli, $id) {
    $sql = "update contact_photos set num_refs = num_refs + 1 where id = $id";
    $mysqli->query($sql) || trigger_error($mysqli->error);
}
