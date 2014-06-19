<?php

namespace Files\File;

function path ($id_users, $id) {
    include_once __DIR__.'/dir.php';
    return dir($id_users)."/$id";
}
