<?php

include_once '../../fns/require_same_domain_referer.php';
require_same_domain_referer('..');

include_once '../fns/require_file.php';
include_once '../../lib/mysqli.php';
list($file, $id, $user) = require_file($mysqli);
$idusers = $user->idusers;

include_once '../../fns/request_strings.php';
list($idfolders) = request_strings('idfolders');

include_once '../../fns/redirect.php';

$idfolders = abs((int)$idfolders);
if ($idfolders) {

    include_once '../../fns/Folders/get.php';
    $parentFolder = Folders\get($mysqli, $idusers, $idfolders);

    if (!$parentFolder) redirect("./?id=$id");

}

include_once '../../fns/Files/getByName.php';
$existingFile = Files\getByName($mysqli, $idusers, $idfolders, $file->filename);

if ($existingFile) {
    $_SESSION['files/move-file/idfolders'] = $idfolders;
    $_SESSION['files/move-file/errors'] = array(
        'A file with the same name already exists in this folder.',
    );
    redirect("./?id=$id&idfolders=$idfolders");
}

unset(
    $_SESSION['files/move-file/idfolders'],
    $_SESSION['files/move-file/errors']
);

include_once '../../fns/Files/move.php';
Files\move($mysqli, $idusers, $id, $idfolders);

$_SESSION['files/idfolders'] = $idfolders;
$_SESSION['files/messages'] = array('File has been moved.');
include_once '../../fns/create_folder_link.php';
redirect(create_folder_link($idfolders, '../'));
