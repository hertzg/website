<?php

namespace ReceivedFiles\File;

function path ($receiver_id_users, $id) {
    include_once __DIR__.'/dir.php';
    return dir($receiver_id_users)."/$id";
}
