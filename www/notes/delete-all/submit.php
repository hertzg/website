<?php

include_once '../../lib/sameDomainReferer.php';
include_once '../../fns/redirect.php';
if (!$sameDomainReferer) redirect('../..');

include_once '../../fns/require_user.php';
require_user('../../');

include_once '../../fns/Notes/deleteOnUser.php';
include_once '../../lib/mysqli.php';
Notes\deleteOnUser($mysqli, $idusers);

include_once '../../fns/NoteTags/deleteOnUser.php';
NoteTags\deleteOnUser($mysqli, $idusers);

$_SESSION['notes/index_messages'] = array('All notes have been deleted.');

redirect('..');
