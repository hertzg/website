<?php

include_once '../lib/sameDomainReferer.php';
include_once '../fns/redirect.php';
if (!$sameDomainReferer) redirect('..');
include_once 'lib/require-file.php';
include_once '../fns/request_strings.php';
include_once '../classes/Files.php';

list($filename) = request_strings('filename');

$errors = array();

if (!$filename) {
    $errors[] = 'Enter file name.';
} elseif (Files::getByName($idusers, $id, $filename, $id)) {
    $errors[] = 'File with the same name already exists.';
}

unset($_SESSION['files/rename-file_errors']);

if ($errors) {
    $_SESSION['files/rename-file_errors'] = $errors;
    redirect("rename-file.php?id=$id");
}

Files::rename($idusers, $id, $filename);

$_SESSION['files/view_messages'] = array('Renamed.');
redirect("view.php?id=$id");
