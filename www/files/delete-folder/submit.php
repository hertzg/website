<?php

include_once '../../fns/require_same_domain_referer.php';
require_same_domain_referer('..');

include_once '../fns/require_folder.php';
include_once '../../lib/mysqli.php';
list($folder, $id_folders, $user) = require_folder($mysqli);

include_once '../../fns/Users/Folders/delete.php';
Users\Folders\delete($mysqli, $folder);

$parent_id = $folder->parent_id;

unset($_SESSION['files/errors']);
$_SESSION['files/id_folders'] = $parent_id;
$_SESSION['files/messages'] = ['Folder has been deleted.'];

include_once '../../fns/create_folder_link.php';
include_once '../../fns/redirect.php';
redirect(create_folder_link($parent_id, '../'));
