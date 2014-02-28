<?php

include_once '../../../fns/require_same_domain_referer.php';
require_same_domain_referer('./');

include_once '../../../fns/require_user.php';
require_user('../../../');

include_once '../../../fns/Events/deleteOnUser.php';
include_once '../../../lib/mysqli.php';
Events\deleteOnUser($mysqli, $idusers);

include_once '../../../fns/Users/clearNumEvents.php';
Users\clearNumEvents($mysqli, $idusers);

$_SESSION['calendar/index_messages'] = array('All events have been deleted.');

include_once '../../../fns/redirect.php';
redirect('../..');
