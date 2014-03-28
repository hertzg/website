<?php

include_once '../../fns/require_same_domain_referer.php';
require_same_domain_referer('./');

include_once '../../fns/require_user.php';
$user = require_user('../../');
$idusers = $user->idusers;

include_once '../../fns/request_strings.php';
list($notetext, $tags) = request_strings('notetext', 'tags');

include_once '../../fns/str_collapse_spaces_multiline.php';
$notetext = str_collapse_spaces_multiline($notetext);

include_once '../../fns/str_collapse_spaces.php';
$tags = str_collapse_spaces($tags);

$errors = [];

if ($notetext === '') $errors[] = 'Enter text.';

include_once '../../fns/parse_tags.php';
parse_tags($tags, $tagnames, $errors);

include_once '../../fns/redirect.php';

if ($errors) {
    $_SESSION['notes/new/errors'] = $errors;
    $_SESSION['notes/new/values'] = [
        'notetext' => $notetext,
        'tags' => $tags,
    ];
    redirect();
}

unset(
    $_SESSION['notes/new/errors'],
    $_SESSION['notes/new/values']
);

include_once '../../fns/Notes/add.php';
include_once '../../lib/mysqli.php';
$id = Notes\add($mysqli, $idusers, $notetext, $tags);

include_once '../../fns/NoteTags/add.php';
NoteTags\add($mysqli, $idusers, $id, $tagnames, $notetext);

include_once '../../fns/Users/addNumNotes.php';
Users\addNumNotes($mysqli, $idusers, 1);

$_SESSION['notes/view/messages'] = ['Note has been saved.'];
redirect("../view/?id=$id");
