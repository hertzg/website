<?php

include_once '../../../lib/defaults.php';

include_once '../../fns/require_same_domain_referer.php';
require_same_domain_referer('./');

include_once '../../fns/require_user.php';
$user = require_user('../../');

include_once '../fns/request_task_params.php';
list($text, $deadline_day, $deadline_month,
    $deadline_year, $deadline_time, $tags, $tag_names,
    $top_priority) = request_task_params($user, $errors, $focus);

$values = [
    'focus' => $focus,
    'text' => $text,
    'deadline_day' => $deadline_day,
    'deadline_month' => $deadline_month,
    'deadline_year' => $deadline_year,
    'deadline_time' => $deadline_time,
    'tags' => $tags,
    'top_priority' => $top_priority,
];

$_SESSION['tasks/new/values'] = $values;

include_once '../../fns/redirect.php';

if ($errors) {
    $_SESSION['tasks/new/errors'] = $errors;
    include_once '../../fns/ItemList/pageQuery.php';
    redirect('./'.ItemList\pageQuery());
}

unset($_SESSION['tasks/new/errors']);

include_once '../../fns/request_strings.php';
list($sendButton) = request_strings('sendButton');
if ($sendButton !== '') {
    $_SESSION['tasks/new/send/task'] = $values;
    unset(
        $_SESSION['tasks/new/send/errors'],
        $_SESSION['tasks/new/send/messages'],
        $_SESSION['tasks/new/send/values']
    );
    include_once '../../fns/ItemList/pageQuery.php';
    redirect('send/'.ItemList\pageQuery());
}

unset($_SESSION['tasks/new/values']);

include_once '../../fns/Users/Tasks/add.php';
include_once '../../lib/mysqli.php';
$id = Users\Tasks\add($mysqli, $user, $text,
    $deadline_time, $tags, $tag_names, $top_priority);

$_SESSION['tasks/view/messages'] = ['Task has been saved.'];

include_once '../../fns/ItemList/itemQuery.php';
redirect('../view/'.ItemList\itemQuery($id));
