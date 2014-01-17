<?php

include_once '../../lib/sameDomainReferer.php';
include_once '../../fns/redirect.php';
if (!$sameDomainReferer) redirect('..');
include_once 'lib/require-user.php';
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
    $_SESSION['notes/new/index_errors'] = $errors;
    $_SESSION['notes/new/index_lastpost'] = array(
        'notetext' => $notetext,
        'tags' => $tags,
    );
    redirect();
}

unset(
    $_SESSION['notes/new/index_errors'],
    $_SESSION['notes/new/index_lastpost']
);

include_once '../../classes/Notes.php';
$id = Notes::add($idusers, $notetext, $tags);

include_once '../../classes/NoteTags.php';
NoteTags::add($idusers, $id, $tagnames, $notetext);

$_SESSION['notes/view/index_messages'] = array('Note has been saved.');
redirect("../view/?id=$id");
