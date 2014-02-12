<?php

include_once '../../lib/sameDomainReferer.php';
include_once '../../fns/redirect.php';
if (!$sameDomainReferer) redirect('../..');
include_once 'lib/require-note.php';
include_once '../../fns/request_strings.php';
include_once '../../fns/str_collapse_spaces.php';
include_once '../../fns/str_collapse_spaces_multiline.php';
include_once '../../classes/Tags.php';

list($notetext, $tags) = request_strings('notetext', 'tags');

$notetext = str_collapse_spaces_multiline($notetext);
$tags = str_collapse_spaces($tags);

$errors = array();

if ($notetext === '') $errors[] = 'Enter text.';

$tagnames = Tags::parse($tags);
if (count($tagnames) > Tags::MAX_NUM_TAGS) {
    $errors[] = 'Please, enter maximum '.Tags::MAX_NUM_TAGS.' tags.';
}

if ($errors) {
    $_SESSION['notes/edit_errors'] = $errors;
    $_SESSION['notes/edit_lastpost'] = array(
        'notetext' => $notetext,
        'tags' => $tags,
    );
    redirect("./?id=$id");
}

unset(
    $_SESSION['notes/edit_errors'],
    $_SESSION['notes/edit_lastpost']
);

include_once '../../fns/Notes/edit.php';
include_once '../../lib/mysqli.php';
Notes\edit($mysqli, $idusers, $id, $notetext, $tags);

include_once '../../classes/NoteTags.php';
NoteTags::deleteOnNote($id);
NoteTags::add($idusers, $id, $tagnames, $notetext);

$_SESSION['notes/view/index_messages'] = array('Changes have been saved.');
redirect("../view/?id=$id");
