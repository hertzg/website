<?php

namespace ReceivedFiles\File;

function delete ($receiver_id_users, $id) {
    include_once __DIR__.'/path.php';
    $path = path($receiver_id_users, $id);
    if (is_file($path)) unlink($path);
}
