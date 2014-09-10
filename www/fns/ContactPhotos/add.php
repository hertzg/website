<?php

namespace ContactPhotos;

function add ($mysqli, $content) {

    $sql = 'insert into contact_photos () values()';
    $mysqli->query($sql) || trigger_error($mysqli->error);
    $id = $mysqli->insert_id;

    include_once __DIR__.'/path.php';
    $path = path($id);

    file_put_contents($path, $content);

}
