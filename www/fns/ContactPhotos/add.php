<?php

namespace ContactPhotos;

function add ($mysqli, $content) {

    $insert_time = time();
    $sql = "insert into contact_photos (insert_time) values ($insert_time)";
    $mysqli->query($sql) || trigger_error($mysqli->error);
    $id = $mysqli->insert_id;

    include_once __DIR__.'/path.php';
    $path = path($id);

    file_put_contents($path, $content);

    return $id;

}
