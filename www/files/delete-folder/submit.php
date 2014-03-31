<?php

include_once '../../fns/require_same_domain_referer.php';
require_same_domain_referer('..');

include_once '../fns/require_folder.php';
include_once '../../lib/mysqli.php';
list($folder, $id_folders, $user) = require_folder($mysqli);

include_once '../../fns/Folders/delete.php';
Folders\delete($mysqli, $user->id_users, $id_folders);

$_SESSION['files/id_folders'] = $folder->parent_id_folders;
$_SESSION['files/messages'] = ['Folder has been deleted.'];

include_once '../../fns/create_folder_link.php';
include_once '../../fns/redirect.php';
redirect(create_folder_link($folder->parent_id_folders, '../'));
