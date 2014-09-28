<?php

namespace ReceivedFiles\File;

function dir ($receiver_id_users) {
    include_once __DIR__.'/../../Users/Directory/path.php';
    return \Users\Directory\path($receiver_id_users).'/received-files';
}
