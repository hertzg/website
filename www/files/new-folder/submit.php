<?php

include_once '../../fns/require_same_domain_referer.php';
require_same_domain_referer('..');

include_once '../../fns/require_user.php';
$user = require_user('../../');
$id_users = $user->id_users;

include_once '../../fns/Folders/request.php';
$name = Folders\request();

include_once '../../fns/request_strings.php';
list($parent_id_folders) = request_strings('parent_id_folders');

include_once '../../fns/redirect.php';
include_once '../../lib/mysqli.php';

$parent_id_folders = abs((int)$parent_id_folders);
if ($parent_id_folders) {
    include_once '../../fns/Folders/get.php';
    $parentFolder = Folders\get($mysqli, $id_users, $parent_id_folders);
    if (!$parentFolder) redirect('..');
}

$errors = [];

if ($name === '') {
    $errors[] = 'Enter folder name.';
} else {
    include_once '../../fns/Folders/getByName.php';
    $folder = Folders\getByName($mysqli, $id_users, $parent_id_folders, $name);
    if ($folder) $errors[] = 'Folder with this name already exists.';
}

if ($errors) {
    $_SESSION['files/new-folder/errors'] = $errors;
    $_SESSION['files/new-folder/values'] = ['name' => $name];
    redirect("./?parent_id_folders=$parent_id_folders");
}

unset(
    $_SESSION['files/new-folder/errors'],
    $_SESSION['files/new-folder/values']
);

include_once '../../fns/Folders/add.php';
$id_folders = Folders\add($mysqli, $id_users, $parent_id_folders, $name);

unset($_SESSION['files/errors']);
$_SESSION['files/id_folders'] = $id_folders;
$_SESSION['files/messages'] = ['Folder has been created.'];

include_once '../../fns/create_folder_link.php';
redirect("../?id_folders=$id_folders");
