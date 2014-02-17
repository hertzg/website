<?php

include_once '../lib/sameDomainReferer.php';
include_once '../fns/redirect.php';
if (!$sameDomainReferer) redirect('..');
include_once 'lib/require-file.php';

include_once '../fns/Files/delete.php';
include_once '../lib/mysqli.php';
Files\delete($mysqli, $idusers, $id);

$_SESSION['files/index_idfolders'] = $file->idfolders;
$_SESSION['files/index_messages'] = array('File has been deleted.');

include_once 'fns/create_folder_link.php';
redirect(create_folder_link($file->idfolders));

