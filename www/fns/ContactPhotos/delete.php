<?php

namespace ContactPhotos;

function delete ($mysqli, $id) {

    $sql = "select * from contact_photos where id = $id";
    $contactPhoto = mysqli_single_object($mysqli, $sql);

    if (!$contactPhoto) return;

    if ($contactPhoto->num_refs == 1) {

        $sql = "delete from contact_photos where id = $id";
        $mysqli->query($sql) || trigger_error($mysqli->error);

        include_once __DIR__.'/path.php';
        $path = path($id);

        if (is_file($path)) unlink($path);

    } else {
        $sql = 'update contact_photos set num_refs = num_refs - 1'
            ." where id = $id";
        $mysqli->query($sql) || trigger_error($mysqli->error);
    }

}
