<?php

include_once '../../fns/require_same_domain_referer.php';
require_same_domain_referer('..');

include_once '../fns/require_file.php';
include_once '../../lib/mysqli.php';
list($file, $id, $user) = require_file($mysqli);
$id_users = $user->id_users;

include_once '../../fns/request_strings.php';
list($file_name) = request_strings('file_name');

$errors = [];

include_once '../../fns/str_collapse_spaces.php';
$file_name = str_collapse_spaces($file_name);

if ($file_name === '') {
    $errors[] = 'Enter file name.';
} else {

    include_once '../../fns/Files/getByName.php';
    include_once '../../lib/mysqli.php';
    $existingFile = Files\getByName($mysqli, $id_users,
        $file->id_folders, $file_name, $id);

    if ($existingFile) {
        $errors[] = 'A file with the same name already exists.';
    }

}

include_once '../../fns/redirect.php';

if ($errors) {
    $_SESSION['files/rename-file/errors'] = $errors;
    $_SESSION['files/rename-file/values'] = ['file_name' => $file_name];
    redirect("./?id=$id");
}

unset(
    $_SESSION['files/rename-file/errors'],
    $_SESSION['files/rename-file/values']
);

include_once '../../fns/Files/rename.php';
Files\rename($mysqli, $id_users, $id, $file_name);

$_SESSION['files/view-file/messages'] = ['Renamed.'];
redirect("../view-file/?id=$id");
