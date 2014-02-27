<?php

include_once '../../fns/require_same_domain_referer.php';
require_same_domain_referer('..');

include_once '../fns/require_note.php';
include_once '../../lib/mysqli.php';
list($note, $id) = require_note($mysqli);

include_once '../../fns/Notes/delete.php';
Notes\delete($mysqli, $id);

include_once '../../fns/NoteTags/deleteOnNote.php';
NoteTags\deleteOnNote($mysqli, $id);

include_once '../../fns/Users/addNumNotes.php';
Users\addNumNotes($mysqli, $idusers, -1);

$_SESSION['notes/index_messages'] = array('Note has been deleted.');

include_once '../../fns/redirect.php';
redirect('..');
