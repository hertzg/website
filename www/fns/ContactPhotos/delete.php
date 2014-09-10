<?php

namespace ContactPhotos;

function delete ($mysqli, $id) {

    $sql = "delete from contact_photos where id = $id";
    $mysqli->query($sql) || trigger_error($mysqli->error);

    include_once __DIR__.'/path.php';
    $path = path($id);

    if (is_file($path)) unlink($path);

}
