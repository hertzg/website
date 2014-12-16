<?php

include_once '../../fns/require_same_domain_referer.php';
require_same_domain_referer('..');

include_once '../fns/require_file.php';
include_once '../../lib/mysqli.php';
list($file, $id, $user) = require_file($mysqli);

include_once '../../fns/Users/Files/delete.php';
Users\Files\delete($mysqli, $file);

unset($_SESSION['files/errors']);
$_SESSION['files/id_folders'] = $file->id_folders;
$_SESSION['files/messages'] = ['File has been deleted.'];

include_once '../../fns/create_folder_link.php';
include_once '../../fns/redirect.php';
redirect(create_folder_link($file->id_folders, '../'));
