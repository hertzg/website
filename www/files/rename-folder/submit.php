<?php

include_once '../../fns/require_same_domain_referer.php';
require_same_domain_referer('..');

include_once '../fns/require_folder.php';
include_once '../../lib/mysqli.php';
list($folder, $idfolders, $user) = require_folder($mysqli);
$idusers = $user->idusers;

include_once '../../fns/request_strings.php';
list($foldername) = request_strings('foldername');

$errors = array();

include_once '../../fns/str_collapse_spaces.php';
$foldername = str_collapse_spaces($foldername);

if ($foldername === '') {
    $errors[] = 'Enter folder name.';
} else {
    include_once '../../fns/Folders/getByName.php';
    if (Folders\getByName($mysqli, $idusers, $folder->parentidfolders, $foldername, $idfolders)) {
        $errors[] = 'Folder with this name already exists.';
    }
}

include_once '../../fns/redirect.php';

if ($errors) {
    $_SESSION['files/rename-folder_errors'] = $errors;
    $_SESSION['files/rename-folder_lastpost'] = array(
        'foldername' => $foldername,
    );
    redirect("./?idfolders=$idfolders");
}

unset(
    $_SESSION['files/rename-folder_errors'],
    $_SESSION['files/rename-folder_lastpost']
);

include_once '../../fns/Folders/rename.php';
Folders\rename($mysqli, $idusers, $idfolders, $foldername);

$_SESSION['files/index_idfolders'] = $idfolders;
$_SESSION['files/index_messages'] = array('Renamed.');

include_once '../fns/create_folder_link.php';
redirect(create_folder_link($idfolders, '../'));
