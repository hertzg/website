<?php

include_once '../lib/sameDomainReferer.php';
include_once '../fns/redirect.php';
if (!$sameDomainReferer) redirect('..');
include_once 'lib/require-file.php';
include_once 'fns/create_folder_link.php';
include_once '../classes/Files.php';
Files::delete($idusers, $id);
$_SESSION['files/index_idfolders'] = $file->idfolders;
$_SESSION['files/index_messages'] = array('File has been deleted.');
redirect(create_folder_link($file->idfolders));
