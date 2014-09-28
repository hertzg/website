<?php

namespace Files\File;

function dir ($id_users) {
    include_once __DIR__.'/../../Users/Directory/path.php';
    return \Users\Directory\path($id_users).'/files';
}
