<?php

include_once '../../lib/sameDomainReferer.php';
include_once '../../fns/redirect.php';
if (!$sameDomainReferer) redirect('../..');
include_once 'lib/require-user.php';

include_once '../../fns/Notes/deleteOnUser.php';
include_once '../../lib/mysqli.php';
Notes\deleteOnUser($mysqli, $idusers);

include_once '../../classes/NoteTags.php';
NoteTags::deleteOnUser($idusers);

$_SESSION['notes/index_messages'] = array('All notes have been deleted.');

redirect('..');
