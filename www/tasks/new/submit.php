<?php

include_once '../../fns/require_same_domain_referer.php';
require_same_domain_referer('./');

include_once '../../fns/require_user.php';
$user = require_user('../../');
$id_users = $user->id_users;

include_once '../../fns/Tasks/requestText.php';
$text = Tasks\requestText();

include_once '../../fns/request_strings.php';
list($top_priority, $tags) = request_strings('top_priority', 'tags');

$top_priority = (bool)$top_priority;

include_once '../../fns/str_collapse_spaces.php';
$tags = str_collapse_spaces($tags);

$errors = [];

if ($text === '') $errors[] = 'Enter text.';

include_once '../../fns/parse_tags.php';
parse_tags($tags, $tag_names, $errors);

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

include_once '../../fns/Tasks/add.php';
include_once '../../lib/mysqli.php';
$id = Tasks\add($mysqli, $id_users, $text, $top_priority, $tags);

include_once '../../fns/TaskTags/add.php';
TaskTags\add($mysqli, $id_users, $id, $tag_names, $text, $top_priority, $tags);

$_SESSION['tasks/view/messages'] = ['Task has been saved.'];
redirect("../view/?id=$id");
