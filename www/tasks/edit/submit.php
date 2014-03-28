<?php

include_once '../../fns/require_same_domain_referer.php';
require_same_domain_referer('..');

include_once '../fns/require_task.php';
include_once '../../lib/mysqli.php';
list($task, $id, $user) = require_task($mysqli);
$idusers = $user->idusers;

include_once '../../fns/request_strings.php';
list($tasktext, $tags) = request_strings('tasktext', 'tags');

include_once '../../fns/str_collapse_spaces_multiline.php';
$tasktext = str_collapse_spaces_multiline($tasktext);

include_once '../../fns/str_collapse_spaces.php';
$tags = str_collapse_spaces($tags);

$errors = [];

if ($tasktext === '') $errors[] = 'Enter text.';

include_once '../../fns/parse_tags.php';
parse_tags($tags, $tagnames, $errors);

include_once '../../fns/redirect.php';

if ($errors) {
    $_SESSION['tasks/edit/errors'] = $errors;
    $_SESSION['tasks/edit/values'] = [
        'tasktext' => $tasktext,
        'tags' => $tags,
    ];
    redirect("./?id=$id");
}

unset(
    $_SESSION['tasks/edit/errors'],
    $_SESSION['tasks/edit/values']
);

include_once '../../fns/Tasks/edit.php';
Tasks\edit($mysqli, $idusers, $id, $tasktext, $tags);

include_once '../../fns/TaskTags/deleteOnTask.php';
TaskTags\deleteOnTask($mysqli, $id);

include_once '../../fns/TaskTags/add.php';
TaskTags\add($mysqli, $idusers, $id, $tagnames, $tasktext, $tags);

$_SESSION['tasks/view/messages'] = ['Changes have been saved.'];
redirect("../view/?id=$id");
