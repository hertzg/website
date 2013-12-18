<?php

include_once '../lib/sameDomainReferer.php';
include_once '../fns/redirect.php';
if (!$sameDomainReferer) redirect('..');
include_once 'lib/require-folder.php';
include_once 'fns/create_folder_link.php';
include_once '../classes/Folders.php';
Folders::delete($idusers, $idfolders);
$_SESSION['files/index_idfolders'] = $folder->parentidfolders;
$_SESSION['files/index_messages'] = array('Folder has been deleted.');
redirect(create_folder_link($folder->parentidfolders));
