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
    $existingFolder = Folders\getByName($mysqli, $idusers,
        $folder->parentidfolders, $foldername, $idfolders);

    if ($existingFolder) {
        $errors[] = 'Folder with this name already exists.';
    }

}

include_once '../../fns/redirect.php';

if ($errors) {
    $_SESSION['files/rename-folder/errors'] = $errors;
    $_SESSION['files/rename-folder/values'] = array(
        'foldername' => $foldername,
    );
    redirect("./?idfolders=$idfolders");
}

unset(
    $_SESSION['files/rename-folder/errors'],
    $_SESSION['files/rename-folder/values']
);

include_once '../../fns/Folders/rename.php';
Folders\rename($mysqli, $idusers, $idfolders, $foldername);

$_SESSION['files/idfolders'] = $idfolders;
$_SESSION['files/messages'] = array('Renamed.');

include_once '../../fns/create_folder_link.php';
redirect(create_folder_link($idfolders, '../'));
