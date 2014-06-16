<?php

namespace Files\File;

function delete ($id_users, $id) {
    include_once __DIR__.'/path.php';
    $path = path($id_users, $id);
    if (is_file($path)) unlink($path);
}
