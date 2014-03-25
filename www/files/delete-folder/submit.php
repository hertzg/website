<?php

include_once '../../fns/require_same_domain_referer.php';
require_same_domain_referer('..');

include_once '../fns/require_folder.php';
include_once '../../lib/mysqli.php';
list($folder, $idfolders, $user) = require_folder($mysqli);

include_once '../../fns/Folders/delete.php';
Folders\delete($mysqli, $user->idusers, $idfolders);

$_SESSION['files/idfolders'] = $folder->parentidfolders;
$_SESSION['files/messages'] = array('Folder has been deleted.');

include_once '../../fns/create_folder_link.php';
include_once '../../fns/redirect.php';
redirect(create_folder_link($folder->parentidfolders, '../'));
