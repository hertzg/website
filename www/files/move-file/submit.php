<?php

include_once '../../fns/require_same_domain_referer.php';
require_same_domain_referer('..');

include_once '../fns/require_file.php';
include_once '../../lib/mysqli.php';
list($file, $id, $user) = require_file($mysqli);
$id_users = $user->id_users;

include_once '../../fns/request_strings.php';
list($id_folders) = request_strings('id_folders');

include_once '../../fns/redirect.php';

$id_folders = abs((int)$id_folders);
if ($id_folders) {

    include_once '../../fns/Folders/get.php';
    $parentFolder = Folders\get($mysqli, $id_users, $id_folders);

    if (!$parentFolder) redirect("./?id=$id");

}

include_once '../../fns/Files/getByName.php';
$existingFile = Files\getByName($mysqli, $id_users, $id_folders, $file->name);

if ($existingFile) {
    $_SESSION['files/move-file/id_folders'] = $id_folders;
    $_SESSION['files/move-file/errors'] = [
        'A file with the same name already exists in this folder.',
    ];
    redirect("./?id=$id&id_folders=$id_folders");
}

unset(
    $_SESSION['files/move-file/id_folders'],
    $_SESSION['files/move-file/errors']
);

include_once '../../fns/Files/move.php';
Files\move($mysqli, $id, $id_folders);

unset($_SESSION['files/errors']);
$_SESSION['files/id_folders'] = $id_folders;
$_SESSION['files/messages'] = ['File has been moved.'];

include_once '../../fns/create_folder_link.php';
redirect(create_folder_link($id_folders, '../'));
