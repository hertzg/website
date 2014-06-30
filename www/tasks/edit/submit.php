<?php

include_once '../../fns/require_same_domain_referer.php';
require_same_domain_referer('..');

include_once '../fns/require_task.php';
include_once '../../lib/mysqli.php';
list($task, $id, $user) = require_task($mysqli);

$errors = [];

include_once '../fns/request_task_params.php';
list($text, $tags, $tag_names, $top_priority) = request_task_params($errors);

include_once '../../fns/ItemList/itemQuery.php';
$itemQuery = ItemList\itemQuery($id);

$_SESSION['tasks/edit/values'] = [
    'text' => $text,
    'tags' => $tags,
    'top_priority' => $top_priority,
];

include_once '../../fns/redirect.php';

if ($errors) {
    $_SESSION['tasks/edit/errors'] = $errors;
    redirect("./$itemQuery");
}

unset($_SESSION['tasks/edit/errors']);

include_once '../../fns/request_strings.php';
list($sendButton) = request_strings('sendButton');
if ($sendButton) redirect("send/$itemQuery");

unset($_SESSION['tasks/edit/values']);

$deadline_time = null;

include_once '../../fns/Users/Tasks/edit.php';
Users\Tasks\edit($mysqli, $user->id_users, $id,
    $text, $deadline_time, $tags, $tag_names, $top_priority);

$_SESSION['tasks/view/messages'] = ['Changes have been saved.'];
redirect("../view/$itemQuery");
