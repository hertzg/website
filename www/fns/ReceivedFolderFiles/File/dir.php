<?php

namespace ReceivedFolderFiles\File;

function dir ($id_users) {
    include_once __DIR__.'/../../Users/Directory/path.php';
    return \Users\Directory\path($id_users).'/received-folder-files';
}
