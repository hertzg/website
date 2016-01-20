<?php

include_once '../../fns/require_same_domain_referer.php';
require_same_domain_referer('..');

include_once '../fns/require_parent_folder.php';
include_once '../../lib/mysqli.php';
list($parentFolder, $parent_id, $user) = require_parent_folder($mysqli);
$id_users = $user->id_users;

include_once '../../fns/Folders/request.php';
$name = Folders\request();

$errors = [];

if ($name === '') {
    $errors[] = 'Enter folder name.';
} else {
    include_once '../../fns/Folders/getByName.php';
    $folder = Folders\getByName($mysqli, $id_users, $parent_id, $name);
    if ($folder) $errors[] = 'A folder with this name already exists.';
}

include_once '../../fns/redirect.php';

if ($errors) {
    $_SESSION['files/new-folder/errors'] = $errors;
    $_SESSION['files/new-folder/values'] = ['name' => $name];
    redirect("./?parent_id=$parent_id");
}

unset(
    $_SESSION['files/new-folder/errors'],
    $_SESSION['files/new-folder/values']
);

include_once '../../fns/Users/Folders/add.php';
$id_folders = Users\Folders\add($mysqli, $id_users, $parent_id, $name);

unset($_SESSION['files/errors']);
$_SESSION['files/id_folders'] = $id_folders;
$_SESSION['files/messages'] = ['Folder has been created.'];

redirect("../?id_folders=$id_folders");
