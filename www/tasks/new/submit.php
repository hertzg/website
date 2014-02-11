<?php

include_once '../../lib/sameDomainReferer.php';
include_once '../../fns/redirect.php';
if (!$sameDomainReferer) redirect('..');
include_once 'lib/require-user.php';
include_once '../../classes/Tags.php';

include_once '../../fns/request_strings.php';
list($tasktext, $tags) = request_strings('tasktext', 'tags');

include_once '../../fns/str_collapse_spaces_multiline.php';
$tasktext = str_collapse_spaces_multiline($tasktext);

include_once '../../fns/str_collapse_spaces.php';
$tags = str_collapse_spaces($tags);

$errors = array();

if ($tasktext === '') $errors[] = 'Enter text.';

$tagnames = Tags::parse($tags);
if (count($tagnames) > Tags::MAX_NUM_TAGS) {
    $errors[] = 'Please, enter maximum '.Tags::MAX_NUM_TAGS.' tags.';
}

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

include_once '../../classes/TaskTags.php';
TaskTags::add($idusers, $id, $tagnames, $tasktext, $tags);

$_SESSION['tasks/view/index_messages'] = array('Task has been saved.');
redirect("../view/?id=$id");
