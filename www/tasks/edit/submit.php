<?php

include_once '../../fns/require_same_domain_referer.php';
require_same_domain_referer('..');

include_once '../fns/require_task.php';
include_once '../../lib/mysqli.php';
list($task, $id, $user) = require_task($mysqli);
$id_users = $user->id_users;

$errors = [];

include_once '../fns/request_task_params.php';
list($text, $tags, $tag_names, $top_priority) = request_task_params($errors);

include_once '../../fns/ItemList/itemQuery.php';
$itemQuery = ItemList\itemQuery($id);

include_once '../../fns/redirect.php';

if ($errors) {
    $_SESSION['tasks/edit/errors'] = $errors;
    $_SESSION['tasks/edit/values'] = [
        'text' => $text,
        'tags' => $tags,
        'top_priority' => $top_priority,
    ];
    redirect("./$itemQuery");
}

unset(
    $_SESSION['tasks/edit/errors'],
    $_SESSION['tasks/edit/values']
);

include_once '../../fns/Tasks/edit.php';
Tasks\edit($mysqli, $id_users, $id, $text, $tags, $top_priority);

include_once '../../fns/TaskTags/deleteOnTask.php';
TaskTags\deleteOnTask($mysqli, $id);

include_once '../../fns/TaskTags/add.php';
TaskTags\add($mysqli, $id_users, $id, $tag_names,
    $text, $top_priority, $tags, $top_priority);

$_SESSION['tasks/view/messages'] = ['Changes have been saved.'];
redirect("../view/$itemQuery");
