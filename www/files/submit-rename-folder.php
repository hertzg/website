<?php

include_once '../lib/sameDomainReferer.php';
include_once '../fns/redirect.php';
if (!$sameDomainReferer) redirect('..');
include_once 'lib/require-folder.php';
include_once 'fns/create_folder_link.php';
include_once '../fns/request_strings.php';
include_once '../fns/str_collapse_spaces.php';
include_once '../classes/Folders.php';

list($foldername) = request_strings('foldername');

$errors = array();

$foldername = str_collapse_spaces($foldername);
if ($foldername === '') {
    $errors[] = 'Enter folder name.';
} elseif (Folders::get($idusers, $foldername, $idfolders)) {
    $errors[] = 'Folder with this name already exists.';
}

unset($_SESSION['files/rename-folder_errors']);

if ($errors) {
    $_SESSION['files/rename-folder_errors'] = $errors;
    redirect("rename-folder.php?idfolders=$idfolders");
}

Folders::rename($idusers, $idfolders, $foldername);

$_SESSION['files/index_idfolders'] = $idfolders;
$_SESSION['files/index_messages'] = array('Renamed.');
redirect(create_folder_link($idfolders));
