<?php

include_once '../../lib/sameDomainReferer.php';
include_once '../../fns/redirect.php';
if (!$sameDomainReferer) redirect('../..');

include_once '../fns/require_file.php';
include_once '../../lib/mysqli.php';
list($file, $id) = require_file($mysqli);

include_once '../fns/create_folder_link.php';

include_once '../../fns/request_strings.php';
list($idfolders) = request_strings('idfolders');

$idfolders = abs((int)$idfolders);
if ($idfolders) {

    include_once '../../fns/Folders/get.php';
    $parentFolder = Folders\get($mysqli, $idusers, $idfolders);

    if (!$parentFolder) redirect("./?id=$id");

}

include_once '../../fns/Files/getByName.php';
$existingFile = Files\getByName($mysqli, $idusers, $idfolders, $file->filename);

if ($existingFile) {
    $_SESSION['files/move-file_idfolders'] = $idfolders;
    $_SESSION['files/move-file_errors'] = array(
        'A file with the same name already exists in this folder.',
    );
    redirect("./?id=$id&idfolders=$idfolders");
}

unset(
    $_SESSION['files/move-file_idfolders'],
    $_SESSION['files/move-file_errors']
);

include_once '../../fns/Files/move.php';
Files\move($mysqli, $idusers, $id, $idfolders);

$_SESSION['files/index_idfolders'] = $idfolders;
$_SESSION['files/index_messages'] = array('File has been moved.');
redirect(create_folder_link($idfolders, '../'));
