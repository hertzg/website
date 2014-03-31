<?php

include_once '../../fns/require_same_domain_referer.php';
require_same_domain_referer('./');

include_once '../../fns/require_user.php';
$user = require_user('../../');
$id_users = $user->id_users;

include_once '../../fns/request_strings.php';
list($note_text, $tags) = request_strings('note_text', 'tags');

include_once '../../fns/str_collapse_spaces_multiline.php';
$note_text = str_collapse_spaces_multiline($note_text);

include_once '../../fns/str_collapse_spaces.php';
$tags = str_collapse_spaces($tags);

$errors = [];

if ($note_text === '') $errors[] = 'Enter text.';

include_once '../../fns/parse_tags.php';
parse_tags($tags, $tag_names, $errors);

include_once '../../fns/redirect.php';

if ($errors) {
    $_SESSION['notes/new/errors'] = $errors;
    $_SESSION['notes/new/values'] = [
        'note_text' => $note_text,
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
$id = Notes\add($mysqli, $id_users, $note_text, $tags);

include_once '../../fns/NoteTags/add.php';
NoteTags\add($mysqli, $id_users, $id, $tag_names, $note_text);

include_once '../../fns/Users/addNumNotes.php';
Users\addNumNotes($mysqli, $id_users, 1);

$_SESSION['notes/view/messages'] = ['Note has been saved.'];
redirect("../view/?id=$id");
