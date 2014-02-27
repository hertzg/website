<?php

include_once '../../fns/require_same_domain_referer.php';
require_same_domain_referer('./');

include_once '../../fns/require_user.php';
require_user('../../');

include_once '../../fns/Notes/deleteOnUser.php';
include_once '../../lib/mysqli.php';
Notes\deleteOnUser($mysqli, $idusers);

include_once '../../fns/NoteTags/deleteOnUser.php';
NoteTags\deleteOnUser($mysqli, $idusers);

include_once '../../fns/Users/clearNumNotes.php';
Users\clearNumNotes($mysqli, $idusers);

$_SESSION['notes/index_messages'] = array('All notes have been deleted.');

include_once '../../fns/redirect.php';
redirect('..');
