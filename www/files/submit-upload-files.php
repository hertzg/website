<?php

include_once '../lib/sameDomainReferer.php';
include_once '../fns/redirect.php';
if (!$sameDomainReferer) redirect('..');
include_once 'lib/require-user.php';
include_once 'fns/create_folder_link.php';

include_once '../fns/request_strings.php';
list($idfolders, $posttest) = request_strings('idfolders', 'posttest');

include_once '../fns/request_multiple_files.php';
list($file1, $file2, $file3) = request_multiple_files('file1', 'file2', 'file3');

include_once '../lib/mysqli.php';

$idfolders = abs((int)$idfolders);
if ($idfolders) {
    include_once '../fns/Folders/get.php';
    $parentFolder = Folders\get($mysqli, $idusers, $idfolders);
    if (!$parentFolder) redirect();
}

include_once '../fns/str_collapse_spaces.php';
include_once '../fns/Files/add.php';
include_once '../fns/Files/getByName.php';

$numfiles = 0;
foreach (array($file1, $file2, $file3) as $file) {
    foreach ($file['name'] as $i => $filename) {
        if ($file['error'][$i] == UPLOAD_ERR_OK) {

            $filename = str_collapse_spaces($filename);
   
            while (Files\getByName($mysqli, $idusers, $idfolders, $filename)) {
                $extension = '';
                if (preg_match('/\..*?$/', $filename, $match)) {
                    $filename = preg_replace('/\..*?$/', '', $filename);
                    $extension = $match[0];
                }
                if (preg_match('/_(\d+)$/', $filename, $match)) {
                    $filename = preg_replace('/_\d+$/', '_'.($match[1] + 1), $filename);
                } else {
                    $filename .= '_1';
                }
                if ($extension) {
                    $filename = "$filename$extension";
                }
            }

            Files\add($mysqli, $idusers, $idfolders, $filename, $file['tmp_name'][$i]);

            $numfiles++;

        }
    }
}

$errors = array();

if (!$posttest) {
    $errors[] = 'Maximum upload size excceeded.';
} elseif (!$numfiles) {
    $errors[] = 'Select files to upload.';
}

if ($errors) {
    $_SESSION['files/upload-files_errors'] = $errors;
    redirect("upload-files.php?idfolders=$idfolders");
}

unset($_SESSION['files/upload-files_errors']);

if ($numfiles == 1) {
    $message = '1 file has been uploaded.';
} else {
    $message = "$numfiles files have been uploaded.";
}

$_SESSION['files/index_idfolders'] = $idfolders;
$_SESSION['files/index_messages'] = array($message);
redirect(create_folder_link($idfolders));
