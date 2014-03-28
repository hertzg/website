<?php

include_once '../../fns/require_same_domain_referer.php';
require_same_domain_referer('..');

include_once '../fns/require_file.php';
include_once '../../lib/mysqli.php';
list($file, $id, $user) = require_file($mysqli);
$idusers = $user->idusers;

include_once '../../fns/request_strings.php';
list($filename) = request_strings('filename');

$errors = [];

include_once '../../fns/str_collapse_spaces.php';
$filename = str_collapse_spaces($filename);

if ($filename === '') {
    $errors[] = 'Enter file name.';
} else {

    include_once '../../fns/Files/getByName.php';
    include_once '../../lib/mysqli.php';
    $existingFile = Files\getByName($mysqli, $idusers, $file->idfolders, $filename, $id);

    if ($existingFile) {
        $errors[] = 'A file with the same name already exists.';
    }

}

include_once '../../fns/redirect.php';

if ($errors) {
    $_SESSION['files/rename-file/errors'] = $errors;
    $_SESSION['files/rename-file/values'] = ['filename' => $filename];
    redirect("./?id=$id");
}

unset(
    $_SESSION['files/rename-file/errors'],
    $_SESSION['files/rename-file/values']
);

include_once '../../fns/Files/rename.php';
Files\rename($mysqli, $idusers, $id, $filename);

$_SESSION['files/view-file/messages'] = ['Renamed.'];
redirect("../view-file/?id=$id");
