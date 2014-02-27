<?php

include_once '../../fns/require_same_domain_referer.php';
require_same_domain_referer('./');

include_once '../../fns/require_user.php';
require_user('../../');

include_once '../../fns/request_strings.php';
list($tasktext, $tags) = request_strings('tasktext', 'tags');

include_once '../../fns/str_collapse_spaces_multiline.php';
$tasktext = str_collapse_spaces_multiline($tasktext);

include_once '../../fns/str_collapse_spaces.php';
$tags = str_collapse_spaces($tags);

$errors = array();

if ($tasktext === '') $errors[] = 'Enter text.';

include_once '../../classes/Tags.php';
$tagnames = Tags::parse($tags);
if (count($tagnames) > Tags::MAX_NUM_TAGS) {
    $errors[] = 'Please, enter maximum '.Tags::MAX_NUM_TAGS.' tags.';
}

include_once '../../fns/redirect.php';

if ($errors) {
    $_SESSION['tasks/new/index_errors'] = $errors;
    $_SESSION['tasks/new/index_lastpost'] = array(
        'tasktext' => $tasktext,
        'tags' => $tags,
    );
    redirect();
}

unset(
    $_SESSION['tasks/new/index_errors'],
    $_SESSION['tasks/new/index_lastpost']
);

include_once '../../fns/Tasks/add.php';
include_once '../../lib/mysqli.php';
$id = Tasks\add($mysqli, $idusers, $tasktext, $tags);

include_once '../../fns/TaskTags/add.php';
TaskTags\add($mysqli, $idusers, $id, $tagnames, $tasktext, $tags);

include_once '../../fns/Users/addNumTasks.php';
Users\addNumTasks($mysqli, $idusers, 1);

$_SESSION['tasks/view/index_messages'] = array('Task has been saved.');
redirect("../view/?id=$id");
