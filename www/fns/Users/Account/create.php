<?php

namespace Users\Account;

function create ($mysqli, $username, $password, $email) {

    $fnsDir = __DIR__.'/../..';

    include_once __DIR__.'/../add.php';
    $id = \Users\add($mysqli, $username, $password, $email);

    include_once __DIR__.'/../Directory/path.php';
    mkdir(\Users\Directory\path($id));

    include_once "$fnsDir/Files/File/dir.php";
    mkdir(\Files\File\dir($id));

    include_once "$fnsDir/ReceivedFiles/File/dir.php";
    mkdir(\ReceivedFiles\File\dir($id));

    include_once "$fnsDir/ReceivedFolderFiles/File/dir.php";
    mkdir(\ReceivedFolderFiles\File\dir($id));

}
