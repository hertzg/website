<?php

include_once '../lib/sameDomainReferer.php';
include_once '../fns/redirect.php';
if (!$sameDomainReferer) redirect('..');
include_once 'lib/require-user.php';
include_once 'fns/create_folder_link.php';
include_once '../fns/request_strings.php';
include_once '../fns/str_collapse_spaces.php';
include_once '../classes/Folders.php';

list($parentidfolders, $foldername) = request_strings('parentidfolders', 'foldername');

$parentidfolders = abs((int)$parentidfolders);
if ($parentidfolders) {
    $folder = Folders::get($idusers, $parentidfolders);
    if (!$folder) redirect();
}

$errors = array();

$foldername = str_collapse_spaces($foldername);
if ($foldername === '') {
    $errors[] = 'Enter folder name.';
} elseif ($folder = Folders::getByName($idusers, $parentidfolders, $foldername)) {
    $errors[] = 'Folder with this name already exists.';
}

unset(
    $_SESSION['files/add-folder_errors'],
    $_SESSION['files/add-folder_lastpost']
);

if ($errors) {
    $_SESSION['files/add-folder_errors'] = $errors;
    $_SESSION['files/add-folder_lastpost'] = $_POST;
    redirect("add-folder.php?parentidfolders=$parentidfolders");
}

$idfolders = Folders::add($idusers, $parentidfolders, $foldername);

$_SESSION['files/index_idfolders'] = $parentidfolders;
$_SESSION['files/index_messages'] = array('Folder has been created.');
redirect(create_folder_link($parentidfolders));
