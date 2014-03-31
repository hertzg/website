<?php

include_once '../../fns/require_same_domain_referer.php';
require_same_domain_referer('..');

include_once '../../fns/require_user.php';
$user = require_user('../../');
$id_users = $user->id_users;

include_once '../../fns/request_strings.php';
list($id_folders, $posttest) = request_strings('id_folders', 'posttest');

include_once '../../fns/request_multiple_files.php';
list($file1, $file2, $file3) = request_multiple_files('file1', 'file2', 'file3');

include_once '../../lib/mysqli.php';

include_once '../../fns/redirect.php';

$id_folders = abs((int)$id_folders);
if ($id_folders) {
    include_once '../../fns/Folders/get.php';
    $parentFolder = Folders\get($mysqli, $id_users, $id_folders);
    if (!$parentFolder) redirect('..');
}

include_once '../../fns/str_collapse_spaces.php';
include_once '../../fns/Files/add.php';
include_once '../../fns/Files/getByName.php';

$numfiles = 0;
foreach ([$file1, $file2, $file3] as $file) {
    foreach ($file['name'] as $i => $file_name) {
        if ($file['error'][$i] == UPLOAD_ERR_OK) {

            $file_name = str_collapse_spaces($file_name);

            while (Files\getByName($mysqli, $id_users, $id_folders, $file_name)) {
                $extension = '';
                if (preg_match('/\..*?$/', $file_name, $match)) {
                    $file_name = preg_replace('/\..*?$/', '', $file_name);
                    $extension = $match[0];
                }
                if (preg_match('/_(\d+)$/', $file_name, $match)) {
                    $file_name = preg_replace('/_\d+$/', '_'.($match[1] + 1), $file_name);
                } else {
                    $file_name .= '_1';
                }
                if ($extension) {
                    $file_name = "$file_name$extension";
                }
            }

            Files\add($mysqli, $id_users, $id_folders, $file_name, $file['tmp_name'][$i]);

            $numfiles++;

        }
    }
}

$errors = [];

if (!$posttest) {
    $errors[] = 'Maximum upload size excceeded.';
} elseif (!$numfiles) {
    $errors[] = 'Select files to upload.';
}

if ($errors) {
    $_SESSION['files/upload-files/errors'] = $errors;
    redirect("./?id_folders=$id_folders");
}

unset($_SESSION['files/upload-files/errors']);

if ($numfiles == 1) {
    $message = '1 file has been uploaded.';
} else {
    $message = "$numfiles files have been uploaded.";
}

$_SESSION['files/id_folders'] = $id_folders;
$_SESSION['files/messages'] = [$message];

include_once '../../fns/create_folder_link.php';
redirect(create_folder_link($id_folders, '../'));
