<?php

include_once '../lib/sameDomainReferer.php';
include_once '../fns/redirect.php';
if (!$sameDomainReferer) redirect('..');
include_once 'lib/require-note.php';
include_once '../fns/request_strings.php';

list($notetext) = request_strings('notetext');

$errors = array();

if (!$notetext) {
    $errors[] = 'Enter text.';
}

unset($_SESSION['notes/edit_errors']);

if ($errors) {
    $_SESSION['notes/edit_errors'] = $errors;
    redirect("edit.php?id=$id");
}

include_once '../classes/Notes.php';
Notes::edit($idusers, $id, $notetext);

$_SESSION['notes/view_messages'] = array('Changes have been saved.');
redirect("view.php?id=$id");
