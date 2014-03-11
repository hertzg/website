<?php

include_once '../../fns/require_same_domain_referer.php';
require_same_domain_referer('..');

include_once '../fns/require_note.php';
include_once '../../lib/mysqli.php';
list($note, $id, $user) = require_note($mysqli);
$idusers = $user->idusers;

include_once '../../fns/request_strings.php';
list($notetext, $tags) = request_strings('notetext', 'tags');

include_once '../../fns/str_collapse_spaces_multiline.php';
$notetext = str_collapse_spaces_multiline($notetext);

include_once '../../fns/str_collapse_spaces.php';
$tags = str_collapse_spaces($tags);

$errors = array();

if ($notetext === '') $errors[] = 'Enter text.';

include_once '../../fns/parse_tags.php';
parse_tags($tags, $tagnames, $errors);

include_once '../../fns/redirect.php';

if ($errors) {
    $_SESSION['notes/edit/index_errors'] = $errors;
    $_SESSION['notes/edit/index_lastpost'] = array(
        'notetext' => $notetext,
        'tags' => $tags,
    );
    redirect("./?id=$id");
}

unset(
    $_SESSION['notes/edit/index_errors'],
    $_SESSION['notes/edit/index_lastpost']
);

include_once '../../fns/Notes/edit.php';
Notes\edit($mysqli, $idusers, $id, $notetext, $tags);

include_once '../../fns/NoteTags/deleteOnNote.php';
NoteTags\deleteOnNote($mysqli, $id);

include_once '../../fns/NoteTags/add.php';
NoteTags\add($mysqli, $idusers, $id, $tagnames, $notetext);

$_SESSION['notes/view/index_messages'] = array('Changes have been saved.');
redirect("../view/?id=$id");
