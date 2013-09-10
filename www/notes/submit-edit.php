<?php

include_once 'lib/require-note.php';
include_once '../fns/redirect.php';
include_once '../fns/request_strings.php';
include_once '../classes/Notes.php';

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

Notes::edit($idusers, $id, $notetext);

$_SESSION['notes/view_messages'] = array('Changes have been saved.');
redirect("view.php?id=$id");
