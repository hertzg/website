<?php

include_once '../../lib/sameDomainReferer.php';
include_once '../../fns/redirect.php';
if (!$sameDomainReferer) redirect('../..');
include_once 'lib/require-task.php';

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

if ($errors) {
    $_SESSION['tasks/edit_errors'] = $errors;
    $_SESSION['tasks/edit_lastpost'] = array(
        'tasktext' => $tasktext,
        'tags' => $tags,
    );
    redirect("./?id=$id");
}

unset(
    $_SESSION['tasks/edit_errors'],
    $_SESSION['tasks/edit_lastpost']
);

include_once '../../fns/Tasks/edit.php';
include_once '../../lib/mysqli.php';
Tasks\edit($mysqli, $idusers, $id, $tasktext, $tags);

include_once '../../fns/TaskTags/deleteOnTask.php';
TaskTags\deleteOnTask($mysqli, $id);

include_once '../../fns/TaskTags/add.php';
TaskTags\add($mysqli, $idusers, $id, $tagnames, $tasktext, $tags);

$_SESSION['tasks/view/index_messages'] = array('Changes have been saved.');
redirect("../view/?id=$id");
