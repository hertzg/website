<?php

include_once 'lib/require-user.php';
include_once '../fns/redirect.php';
include_once '../fns/request_strings.php';
include_once '../fns/str_collapse_spaces.php';
include_once '../classes/Tags.php';
include_once '../classes/Tasks.php';

list($tasktext, $tags) = request_strings('tasktext', 'tags');

$tags = str_collapse_spaces($tags);

$errors = array();

if (!$tasktext) {
    $errors[] = 'Enter text.';
}

$tagnames = Tags::parse($tags);
if (count($tagnames) > Tags::MAX_NUM_TAGS) {
    $errors[] = 'Please, enter maximum '.Tags::MAX_NUM_TAGS.' tags.';
}

unset($_SESSION['tasks/add_errors']);

if ($errors) {
    $_SESSION['tasks/add_errors'] = $errors;
    redirect('add.php');
}

$id = Tasks::add($idusers, $tasktext, $tags);

include_once '../classes/TaskTags.php';
TaskTags::add($idusers, $id, $tagnames);

$_SESSION['tasks/index_messages'] = array('Task has been saved.');
redirect();
