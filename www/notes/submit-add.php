<?php

include_once '../lib/sameDomainReferer.php';
include_once '../fns/redirect.php';
if (!$sameDomainReferer) redirect('..');
include_once 'lib/require-user.php';
include_once '../fns/str_collapse_spaces_multiline.php';
include_once '../fns/request_strings.php';

list($notetext) = request_strings('notetext');

$errors = array();

$notetext = str_collapse_spaces_multiline($notetext);
if ($notetext === '') $errors[] = 'Enter text.';

unset($_SESSION['notes/add_errors']);

if ($errors) {
    $_SESSION['notes/add_errors'] = $errors;
    redirect('add.php');
}

include_once '../classes/Notes.php';
$id = Notes::add($idusers, $notetext);

$_SESSION['notes/view_messages'] = array('Note has been saved.');
redirect("view.php?id=$id");
