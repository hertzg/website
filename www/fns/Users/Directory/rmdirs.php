<?php

namespace Users\Directory;

function rmdirs ($id) {

    $fnsDir = __DIR__.'/../..';

    include_once "$fnsDir/Files/File/dir.php";
    rmdir(\Files\File\dir($id));

    include_once "$fnsDir/ReceivedFiles/File/dir.php";
    rmdir(\ReceivedFiles\File\dir($id));

    include_once "$fnsDir/ReceivedFolderFiles/File/dir.php";
    rmdir(\ReceivedFolderFiles\File\dir($id));

    include_once __DIR__.'/path.php';
    rmdir(path($id));

}
