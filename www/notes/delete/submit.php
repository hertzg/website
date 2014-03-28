<?php

include_once '../../fns/require_same_domain_referer.php';
require_same_domain_referer('..');

include_once '../fns/require_note.php';
include_once '../../lib/mysqli.php';
list($note, $id, $user) = require_note($mysqli);

include_once '../../fns/Notes/delete.php';
Notes\delete($mysqli, $id);

include_once '../../fns/NoteTags/deleteOnNote.php';
NoteTags\deleteOnNote($mysqli, $id);

include_once '../../fns/Users/addNumNotes.php';
Users\addNumNotes($mysqli, $user->idusers, -1);

unset($_SESSION['notes/errors']);
$_SESSION['notes/messages'] = ['Note has been deleted.'];

include_once '../../fns/redirect.php';
redirect('..');
