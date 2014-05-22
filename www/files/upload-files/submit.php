<?php

include_once '../../fns/require_same_domain_referer.php';
require_same_domain_referer('..');

include_once '../../fns/require_user.php';
$user = require_user('../../');
$id_users = $user->id_users;

include_once '../../fns/request_strings.php';
list($id_folders, $posttest) = request_strings('id_folders', 'posttest');

include_once '../../fns/request_multiple_files.php';
list($file1, $file2, $file3) = request_multiple_files(
    'file1', 'file2', 'file3');

include_once '../../lib/mysqli.php';

include_once '../../fns/redirect.php';

$id_folders = abs((int)$id_folders);
if ($id_folders) {
    include_once '../../fns/Folders/get.php';
    $parentFolder = Folders\get($mysqli, $id_users, $id_folders);
    if (!$parentFolder) redirect('..');
}

include_once '../../fns/str_collapse_spaces.php';
include_once '../../fns/Files/getByName.php';
include_once '../../fns/Users/Files/add.php';

$num_uploaded = 0;
$num_failed = 0;
foreach ([$file1, $file2, $file3] as $file) {
    foreach ($file['name'] as $i => $name) {
        $error = $file['error'][$i];
        if ($error === UPLOAD_ERR_OK) {

            $name = str_collapse_spaces($name);

            while (Files\getByName($mysqli, $id_users, $id_folders, $name)) {
                $extension = '';
                if (preg_match('/\..*?$/', $name, $match)) {
                    $name = preg_replace('/\..*?$/', '', $name);
                    $extension = $match[0];
                }
                if (preg_match('/_(\d+)$/', $name, $match)) {
                    $name = preg_replace('/_\d+$/', '_'.($match[1] + 1), $name);
                } else {
                    $name .= '_1';
                }
                if ($extension) {
                    $name = "$name$extension";
                }
            }

            Users\Files\add($mysqli, $id_users, $id_folders,
                $name, $file['tmp_name'][$i]);

            $num_uploaded++;

        } elseif ($error !== UPLOAD_ERR_NO_FILE) {
            $num_failed++;
        }
    }
}

$errors = [];

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

    if ($id_folders) $queryString = "?id_folders=$id_folders";
    else $queryString = '';

    redirect("./$queryString");

}

unset($_SESSION['files/upload-files/errors']);

if ($num_uploaded == 1) {
    $message = '1 file has been uploaded.';
} else {
    $message = "$num_uploaded files have been uploaded.";
}

if ($errors) $_SESSION['files/errors'] = $errors;
else unset($_SESSION['files/errors']);

$_SESSION['files/id_folders'] = $id_folders;
$_SESSION['files/messages'] = [$message];

include_once '../../fns/create_folder_link.php';
redirect(create_folder_link($id_folders, '../'));
