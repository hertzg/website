<?php

function is_child_folder ($idusers, $folder, $idfolders) {
    while (true) {
        if ($folder->idfolders == $idfolders) return true;
        if (!$folder->parentidfolders) return false;
        $folder = Folders::get($idusers, $folder->parentidfolders);
    }
}

include_once 'lib/require-folder.php';
include_once 'fns/create_folder_link.php';
include_once '../fns/redirect.php';
include_once '../fns/request_strings.php';
include_once '../classes/Folders.php';

list($parentidfolders) = request_strings('parentidfolders');

$parentidfolders = abs((int)$parentidfolders);
if ($parentidfolders) {
    $parentFolder = Folders::get($idusers, $parentidfolders);
    if (!$parentFolder) {
        redirect("move-folder.php?idfolders=$idfolders");
    }
    if (is_child_folder($idusers, $parentFolder, $folder->idfolders)) {
        redirect("move-folder.php?idfolders=$idfolders");
    }
}

$existingFolder = Folders::getByName($idusers, $parentidfolders, $folder->foldername);
if ($existingFolder) {
    $_SESSION['files/move-folder_parentidfolders'] = $parentidfolders;
    $_SESSION['files/move-folder_errors'] = array('A folder with the same name already exists in this folder.');
    redirect("move-folder.php?idfolders=$idfolders&parentidfolders=$parentidfolders");
}

unset(
    $_SESSION['files/move-folder_parentidfolders'],
    $_SESSION['files/move-folder_errors']
);

Folders::move($idusers, $idfolders, $parentidfolders);

$_SESSION['files/index_idfolders'] = $parentidfolders;
$_SESSION['files/index_messages'] = array('File has been moved.');
redirect(create_folder_link($parentidfolders));
