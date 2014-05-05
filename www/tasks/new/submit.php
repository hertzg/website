<?php

include_once '../../fns/require_same_domain_referer.php';
require_same_domain_referer('./');

include_once '../../fns/require_user.php';
$user = require_user('../../');
$id_users = $user->id_users;

$errors = [];

include_once '../fns/request_task_params.php';
list($text, $tags, $tag_names, $top_priority) = request_task_params($errors);

include_once '../../fns/redirect.php';

if ($errors) {
    $_SESSION['tasks/new/errors'] = $errors;
    $_SESSION['tasks/new/values'] = [
        'text' => $text,
        'top_priority' => $top_priority,
        'tags' => $tags,
    ];
    redirect();
}

unset(
    $_SESSION['tasks/new/errors'],
    $_SESSION['tasks/new/values']
);

include_once '../../fns/Users/Tasks/add.php';
include_once '../../lib/mysqli.php';
$id = Users\Tasks\add($mysqli, $id_users,
    $text, $top_priority, $tags, $tag_names);

$_SESSION['tasks/view/messages'] = ['Task has been saved.'];
redirect("../view/?id=$id");
