<?php

include_once '../../fns/require_same_domain_referer.php';
require_same_domain_referer('..');

include_once '../fns/require_task.php';
include_once '../../lib/mysqli.php';
list($task, $id, $user) = require_task($mysqli);
$id_users = $user->id_users;

include_once '../../fns/request_strings.php';
list($task_text, $tags) = request_strings('task_text', 'tags');

include_once '../../fns/str_collapse_spaces_multiline.php';
$task_text = str_collapse_spaces_multiline($task_text);

include_once '../../fns/str_collapse_spaces.php';
$tags = str_collapse_spaces($tags);

$errors = [];

if ($task_text === '') $errors[] = 'Enter text.';

include_once '../../fns/parse_tags.php';
parse_tags($tags, $tag_names, $errors);

include_once '../../fns/redirect.php';

if ($errors) {
    $_SESSION['tasks/edit/errors'] = $errors;
    $_SESSION['tasks/edit/values'] = [
        'task_text' => $task_text,
        'tags' => $tags,
    ];
    redirect("./?id=$id");
}

unset(
    $_SESSION['tasks/edit/errors'],
    $_SESSION['tasks/edit/values']
);

include_once '../../fns/Tasks/edit.php';
Tasks\edit($mysqli, $id_users, $id, $task_text, $tags);

include_once '../../fns/TaskTags/deleteOnTask.php';
TaskTags\deleteOnTask($mysqli, $id);

include_once '../../fns/TaskTags/add.php';
TaskTags\add($mysqli, $id_users, $id, $tag_names, $task_text, $tags);

$_SESSION['tasks/view/messages'] = ['Changes have been saved.'];
redirect("../view/?id=$id");
