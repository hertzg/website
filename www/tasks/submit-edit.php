<?php

include_once 'lib/require-task.php';
include_once '../fns/redirect.php';
include_once '../fns/request_strings.php';
include_once '../fns/str_collapse_spaces.php';
include_once '../classes/Tasks.php';

list($tasktext, $tags) = request_strings('tasktext', 'tags');

$tags = str_collapse_spaces($tags);

$errors = array();

if (!$tasktext) {
    $errors[] = 'Enter text.';
}

unset($_SESSION['tasks/edit_errors']);

if ($errors) {
    $_SESSION['tasks/edit_errors'] = $errors;
    $_SESSION['tasks/edit_lastpost'] = $_POST;
    redirect("edit.php?id=$id");
}

unset(
    $_SESSION['tasks/edit_errors'],
    $_SESSION['tasks/edit_lastpost']
);

Tasks::edit($idusers, $id, $tasktext, $tags);

$_SESSION['tasks/view_messages'] = array('Changes have been saved.');
redirect("view.php?id=$id");
