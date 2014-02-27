<?php

include_once '../../fns/require_same_domain_referer.php';
require_same_domain_referer('./');

include_once '../../fns/require_user.php';
require_user('../../');

include_once '../../fns/request_strings.php';
list($notetext, $tags) = request_strings('notetext', 'tags');

include_once '../../fns/str_collapse_spaces_multiline.php';
$notetext = str_collapse_spaces_multiline($notetext);

include_once '../../fns/str_collapse_spaces.php';
$tags = str_collapse_spaces($tags);

$errors = array();

if ($notetext === '') $errors[] = 'Enter text.';

include_once '../../classes/Tags.php';
$tagnames = Tags::parse($tags);
if (count($tagnames) > Tags::MAX_NUM_TAGS) {
    $errors[] = 'Please, enter maximum '.Tags::MAX_NUM_TAGS.' tags.';
}

include_once '../../fns/redirect.php';

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

include_once '../../fns/Notes/add.php';
include_once '../../lib/mysqli.php';
$id = Notes\add($mysqli, $idusers, $notetext, $tags);

include_once '../../fns/NoteTags/add.php';
NoteTags\add($mysqli, $idusers, $id, $tagnames, $notetext);

include_once '../../fns/Users/addNumNotes.php';
Users\addNumNotes($mysqli, $idusers, 1);

$_SESSION['notes/view/index_messages'] = array('Note has been saved.');
redirect("../view/?id=$id");
