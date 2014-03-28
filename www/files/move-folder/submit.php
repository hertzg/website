<?php

function is_child_folder ($mysqli, $idusers, $folder, $idfolders) {
    while (true) {
        if ($folder->idfolders == $idfolders) return true;
        if (!$folder->parentidfolders) return false;
        $folder = Folders\get($mysqli, $idusers, $folder->parentidfolders);
    }
}

include_once '../../fns/require_same_domain_referer.php';
require_same_domain_referer('..');

include_once '../fns/require_folder.php';
include_once '../../lib/mysqli.php';
list($folder, $idfolders, $user) = require_folder($mysqli);
$idusers = $user->idusers;

include_once '../../fns/request_strings.php';
list($parentidfolders) = request_strings('parentidfolders');

include_once '../../fns/redirect.php';

$parentidfolders = abs((int)$parentidfolders);
if ($parentidfolders) {

    include_once '../../fns/Folders/get.php';
    $parentFolder = Folders\get($mysqli, $idusers, $parentidfolders);

    if (!$parentFolder) redirect("./?idfolders=$idfolders");

    if (is_child_folder($mysqli, $idusers, $parentFolder, $folder->idfolders)) {
        redirect("./?idfolders=$idfolders");
    }

}

include_once '../../fns/Folders/getByName.php';
$existingFolder = Folders\getByName($mysqli, $idusers, $parentidfolders,
    $folder->foldername);

if ($existingFolder) {
    $_SESSION['files/move-folder/parentidfolders'] = $parentidfolders;
    $_SESSION['files/move-folder/errors'] = [
        'A folder with the same name already exists in this folder.',
    ];
    redirect("./?idfolders=$idfolders&parentidfolders=$parentidfolders");
}

unset(
    $_SESSION['files/move-folder/parentidfolders'],
    $_SESSION['files/move-folder/errors']
);

include_once '../../fns/Folders/move.php';
Folders\move($mysqli, $idusers, $idfolders, $parentidfolders);

$_SESSION['files/idfolders'] = $parentidfolders;
$_SESSION['files/messages'] = ['File has been moved.'];

include_once '../../fns/create_folder_link.php';
redirect(create_folder_link($parentidfolders, '../'));
