<?php

include_once '../../../lib/defaults.php';

$fnsDir = '../../fns';

include_once "$fnsDir/require_same_domain_referer.php";
require_same_domain_referer('./');

include_once '../fns/require_notes.php';
$user = require_notes();

include_once "$fnsDir/Users/Notes/deleteAll.php";
include_once '../../lib/mysqli.php';
Users\Notes\deleteAll($mysqli, $user);

unset($_SESSION['notes/errors']);
$_SESSION['notes/messages'] = ['All notes have been deleted.'];

include_once "$fnsDir/redirect.php";
redirect('..');
