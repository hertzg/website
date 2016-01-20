<?php

include_once '../../fns/require_same_domain_referer.php';
require_same_domain_referer('..');

include_once '../fns/require_parent_folder.php';
include_once '../../lib/mysqli.php';
list($parentFolder, $parent_id, $user) = require_parent_folder($mysqli);
$id_users = $user->id_users;

include_once '../../fns/request_multiple_files.php';
list($file1, $file2, $file3) = request_multiple_files(
    'file1', 'file2', 'file3');

include_once '../../fns/redirect.php';
include_once '../../fns/str_collapse_spaces.php';
include_once '../../fns/Files/getUniqueName.php';
include_once '../../fns/Users/Files/add.php';

$num_uploaded = 0;
$num_failed = 0;
foreach ([$file1, $file2, $file3] as $file) {
    foreach ($file['name'] as $i => $name) {
        $error = $file['error'][$i];
        if ($error === UPLOAD_ERR_OK) {
            $name = str_collapse_spaces($name);
            $name = Files\getUniqueName($mysqli, $id_users, $parent_id, $name);
            Users\Files\add($mysqli, $id_users, $parent_id,
                $name, $file['tmp_name'][$i]);
            $num_uploaded++;
        } elseif ($error !== UPLOAD_ERR_NO_FILE) {
            $num_failed++;
        }
    }
}

$errors = [];

include_once '../../fns/request_strings.php';
list($posttest) = request_strings('posttest');

if (!$posttest) {
    $errors[] = 'Maximum upload size excceeded.';
} elseif ($num_failed) {
    if ($num_failed == 1) $text = '1 file has failed to upload.';
    else $text = "$num_failed files have failed to upload.";
    $errors[] = $text;
} elseif (!$num_uploaded) {
    $errors[] = 'Select files to upload.';
}

if (!$num_uploaded) {

    $_SESSION['files/upload-files/errors'] = $errors;

    $url = './';
    if ($parent_id) $url .= "?parent_id=$parent_id";
    redirect($url);

}

unset($_SESSION['files/upload-files/errors']);

if ($num_uploaded == 1) $message = '1 file has been uploaded.';
else $message = "$num_uploaded files have been uploaded.";

if ($errors) $_SESSION['files/errors'] = $errors;
else unset($_SESSION['files/errors']);

$_SESSION['files/id_folders'] = $parent_id;
$_SESSION['files/messages'] = [$message];

include_once '../fns/create_parent_url.php';
redirect(create_parent_url($parent_id, '../'));
