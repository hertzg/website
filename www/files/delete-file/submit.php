<?php

include_once '../../fns/require_same_domain_referer.php';
require_same_domain_referer('..');

include_once '../fns/require_file.php';
include_once '../../lib/mysqli.php';
list($file, $id, $user) = require_file($mysqli);

include_once '../../fns/Files/delete.php';
Files\delete($mysqli, $user->idusers, $id);

$_SESSION['files/idfolders'] = $file->idfolders;
$_SESSION['files/messages'] = array('File has been deleted.');

include_once '../../fns/create_folder_link.php';
include_once '../../fns/redirect.php';
redirect(create_folder_link($file->idfolders, '../'));

