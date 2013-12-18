<?php

include_once '../lib/sameDomainReferer.php';
include_once '../fns/redirect.php';
if (!$sameDomainReferer) redirect('..');
include_once 'lib/require-user.php';
include_once 'fns/create_folder_link.php';
include_once '../fns/request_multiple_files.php';
include_once '../fns/request_strings.php';
include_once '../classes/Files.php';
include_once '../classes/Folders.php';

list($idfolders, $posttest) = request_strings('idfolders', 'posttest');

list($file1, $file2, $file3) = request_multiple_files('file1', 'file2', 'file3');

$idfolders = abs((int)$idfolders);
if ($idfolders) {
    $folder = Folders::get($idusers, $idfolders);
    if (!$folder) redirect();
}

$numfiles = 0;
foreach (array($file1, $file2, $file3) as $file) {
    foreach ($file['name'] as $i => $filename) {
        if ($file['error'][$i] == UPLOAD_ERR_OK) {
            while (Files::getByName($idusers, $idfolders, $filename)) {
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
            Files::add($idusers, $idfolders, $filename, $file['tmp_name'][$i]);
            $numfiles++;
        }
    }
}

unset($_SESSION['files/upload-files_errors']);

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

if ($numfiles == 1) {
    $message = '1 file has been uploaded.';
} else {
    $message = "$numfiles files have been uploaded.";
}

$_SESSION['files/index_idfolders'] = $idfolders;
$_SESSION['files/index_messages'] = array($message);
redirect(create_folder_link($idfolders));
