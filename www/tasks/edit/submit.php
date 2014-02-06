<?php

include_once '../../lib/sameDomainReferer.php';
include_once '../../fns/redirect.php';
if (!$sameDomainReferer) redirect('../..');
include_once 'lib/require-task.php';
include_once '../../fns/request_strings.php';
include_once '../../fns/str_collapse_spaces.php';
include_once '../../fns/str_collapse_spaces_multiline.php';
include_once '../../classes/Tags.php';

list($tasktext, $tags) = request_strings('tasktext', 'tags');

$tasktext = str_collapse_spaces_multiline($tasktext);
$tags = str_collapse_spaces($tags);

$errors = array();

if ($tasktext === '') $errors[] = 'Enter text.';

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

include_once '../../classes/Tasks.php';
Tasks::edit($idusers, $id, $tasktext, $tags);

include_once '../../classes/TaskTags.php';
TaskTags::deleteOnTask($id);
TaskTags::add($idusers, $id, $tagnames, $tasktext, $tags);

$_SESSION['tasks/view/index_messages'] = array('Changes have been saved.');
redirect("../view/?id=$id");
