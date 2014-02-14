<?php

include_once '../../lib/sameDomainReferer.php';
include_once '../../fns/redirect.php';
if (!$sameDomainReferer) redirect('../..');
include_once 'lib/require-note.php';

include_once '../../fns/Notes/delete.php';
include_once '../../lib/mysqli.php';
Notes\delete($mysqli, $id);

include_once '../../fns/NoteTags/deleteOnNote.php';
NoteTags\deleteOnNote($mysqli, $id);

$_SESSION['notes/index_messages'] = array('Note has been deleted.');

redirect('..');
