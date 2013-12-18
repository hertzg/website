<?php

include_once '../lib/sameDomainReferer.php';
include_once '../fns/redirect.php';
if (!$sameDomainReferer) redirect('..');
include_once 'lib/require-file.php';
include_once 'fns/create_folder_link.php';
include_once '../fns/request_strings.php';
include_once '../classes/Files.php';
include_once '../classes/Folders.php';

list($idfolders) = request_strings('idfolders');

$idfolders = abs((int)$idfolders);
if ($idfolders) {
    $folder = Folders::get($idusers, $idfolders);
    if (!$folder) {
        redirect("move-file.php?id=$id");
    }
}

$existingFile = Files::getByName($idusers, $idfolders, $file->filename);
if ($existingFile) {
    $_SESSION['files/move-file_idfolders'] = $idfolders;
    $_SESSION['files/move-file_errors'] = array('A file with the same name already exists in this folder.');
    redirect("move-file.php?id=$id&idfolders=$idfolders");
}

unset(
    $_SESSION['files/move-file_idfolders'],
    $_SESSION['files/move-file_errors']
);

Files::move($idusers, $id, $idfolders);

$_SESSION['files/index_idfolders'] = $idfolders;
$_SESSION['files/index_messages'] = array('File has been moved.');
redirect(create_folder_link($idfolders));
