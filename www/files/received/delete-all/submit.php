<?php

include_once '../../../../lib/defaults.php';

include_once '../../../fns/require_same_domain_referer.php';
require_same_domain_referer('./');

include_once '../fns/require_received_files.php';
$user = require_received_files('../');

include_once '../../../fns/Users/Files/Received/deleteAll.php';
include_once '../../../lib/mysqli.php';
Users\Files\Received\deleteAll($mysqli, $user);

include_once '../../../fns/Users/Folders/Received/deleteAll.php';
Users\Folders\Received\deleteAll($mysqli, $user);

unset($_SESSION['files/errors']);
$_SESSION['files/messages'] = ['All received files have been deleted.'];

include_once '../../../fns/redirect.php';
redirect('../..');
