<?php

include_once '../../fns/require_same_domain_referer.php';
require_same_domain_referer('..');

include_once '../../fns/require_user.php';
$user = require_user('../../');
$idusers = $user->idusers;

include_once '../../lib/mysqli.php';

include_once '../../fns/request_strings.php';
list($parentidfolders, $foldername) = request_strings(
    'parentidfolders', 'foldername');

include_once '../../fns/redirect.php';

$parentidfolders = abs((int)$parentidfolders);
if ($parentidfolders) {
    include_once '../../fns/Folders/get.php';
    $parentFolder = Folders\get($mysqli, $idusers, $parentidfolders);
    if (!$parentFolder) redirect('..');
}

$errors = array();

include_once '../../fns/str_collapse_spaces.php';
$foldername = str_collapse_spaces($foldername);

if ($foldername === '') {
    $errors[] = 'Enter folder name.';
} else {
    include_once '../../fns/Folders/getByName.php';
    if ($folder = Folders\getByName($mysqli, $idusers, $parentidfolders, $foldername)) {
        $errors[] = 'Folder with this name already exists.';
    }
}

if ($errors) {
    $_SESSION['files/add-folder/index_errors'] = $errors;
    $_SESSION['files/add-folder/index_values'] = array('foldername' => $foldername);
    redirect("./?parentidfolders=$parentidfolders");
}

unset(
    $_SESSION['files/add-folder/index_errors'],
    $_SESSION['files/add-folder/index_values']
);

include_once '../../fns/Folders/add.php';
$idfolders = Folders\add($mysqli, $idusers, $parentidfolders, $foldername);

$_SESSION['files/index_idfolders'] = $idfolders;
$_SESSION['files/index_messages'] = array('Folder has been created.');
include_once '../../fns/create_folder_link.php';
redirect("../?idfolders=$idfolders");
