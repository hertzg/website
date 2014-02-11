<?php

include_once '../../lib/sameDomainReferer.php';
include_once '../../fns/redirect.php';
if (!$sameDomainReferer) redirect('../..');
include_once 'lib/require-note.php';

include_once '../../fns/Notes/delete.php';
include_once '../../lib/mysqli.php';
Notes\delete($mysqli, $id);

include_once '../../classes/NoteTags.php';
NoteTags::deleteOnNote($id);

$_SESSION['notes/index_messages'] = array('Note has been deleted.');

redirect('..');
