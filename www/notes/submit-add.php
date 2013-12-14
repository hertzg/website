<?php

include_once 'lib/require-user.php';
include_once '../fns/redirect.php';
include_once '../fns/request_strings.php';

list($notetext) = request_strings('notetext');

$errors = array();

if (!$notetext) {
    $errors[] = 'Enter text.';
}

unset($_SESSION['notes/add_errors']);

if ($errors) {
    $_SESSION['notes/add_errors'] = $errors;
    redirect('add.php');
}

include_once '../classes/Notes.php';
Notes::add($idusers, $notetext);

$_SESSION['notes/index_messages'] = array('Note has been added.');
redirect();
