<?php

namespace Users\Directory;

function mkdirs ($id) {

    $fnsDir = __DIR__.'/../..';

    include_once __DIR__.'/path.php';
    mkdir(path($id));

    include_once "$fnsDir/Files/File/dir.php";
    mkdir(\Files\File\dir($id));

    include_once "$fnsDir/ReceivedFiles/File/dir.php";
    mkdir(\ReceivedFiles\File\dir($id));

    include_once "$fnsDir/ReceivedFolderFiles/File/dir.php";
    mkdir(\ReceivedFolderFiles\File\dir($id));

}
