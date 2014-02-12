<?php

include_once '../lib/sameDomainReferer.php';
include_once '../fns/redirect.php';
if (!$sameDomainReferer) redirect('..');
include_once 'lib/require-user.php';
include_once '../classes/Folders.php';
include_once '../lib/mysqli.php';

include_once '../fns/request_strings.php';
list($parentidfolders, $foldername) = request_strings(
    'parentidfolders', 'foldername');

$parentidfolders = abs((int)$parentidfolders);
if ($parentidfolders) {
    $folder = Folders::get($idusers, $parentidfolders);
    if (!$folder) redirect();
}

$errors = array();

include_once '../fns/str_collapse_spaces.php';
$foldername = str_collapse_spaces($foldername);

if ($foldername === '') {
    $errors[] = 'Enter folder name.';
} else {
    include_once '../fns/Folders/getByName.php';
    if ($folder = Folders\getByName($mysqli, $idusers, $parentidfolders, $foldername)) {
        $errors[] = 'Folder with this name already exists.';
    }
}

if ($errors) {
    $_SESSION['files/add-folder_errors'] = $errors;
    $_SESSION['files/add-folder_lastpost'] = array('foldername' => $foldername);
    redirect("add-folder.php?parentidfolders=$parentidfolders");
}

unset(
    $_SESSION['files/add-folder_errors'],
    $_SESSION['files/add-folder_lastpost']
);

include_once '../fns/Folders/add.php';
$idfolders = Folders\add($mysqli, $idusers, $parentidfolders, $foldername);

$_SESSION['files/index_idfolders'] = $idfolders;
$_SESSION['files/index_messages'] = array('Folder has been created.');
include_once 'fns/create_folder_link.php';
redirect(create_folder_link($idfolders));
