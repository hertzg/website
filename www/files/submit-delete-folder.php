<?php

include_once '../lib/sameDomainReferer.php';
include_once '../fns/redirect.php';
if (!$sameDomainReferer) redirect('..');
include_once 'lib/require-folder.php';

include_once '../fns/Folders/delete.php';
include_once '../lib/mysqli.php';
Folders\delete($mysqli, $idusers, $idfolders);

$_SESSION['files/index_idfolders'] = $folder->parentidfolders;
$_SESSION['files/index_messages'] = array('Folder has been deleted.');

include_once 'fns/create_folder_link.php';
redirect(create_folder_link($folder->parentidfolders));
