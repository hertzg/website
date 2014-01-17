<?php

include_once '../lib/sameDomainReferer.php';
include_once '../fns/redirect.php';
if (!$sameDomainReferer) redirect('..');
include_once 'lib/require-file.php';
include_once '../fns/request_strings.php';
include_once '../fns/str_collapse_spaces.php';
include_once '../classes/Files.php';

list($filename) = request_strings('filename');

$errors = array();

$filename = str_collapse_spaces($filename);
if ($filename === '') {
    $errors[] = 'Enter file name.';
} elseif (Files::getByName($idusers, $file->idfolders, $filename, $id)) {
    $errors[] = 'A file with the same name already exists.';
}

if ($errors) {
    $_SESSION['files/rename-file_errors'] = $errors;
    $_SESSION['files/rename-file_lastpost'] = array('filename' => $filename);
    redirect("rename-file.php?id=$id");
}

unset(
    $_SESSION['files/rename-file_errors'],
    $_SESSION['files/rename-file_lastpost']
);

Files::rename($idusers, $id, $filename);

$_SESSION['files/view/index_messages'] = array('Renamed.');
redirect("view/?id=$id");
