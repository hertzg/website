<?php

$fnsDir = '../../../fns';

include_once "$fnsDir/require_same_domain_referer.php";
require_same_domain_referer('..');

include_once '../fns/require_event.php';
include_once '../../../lib/mysqli.php';
list($event, $id, $user) = require_event($mysqli);

include_once "$fnsDir/Users/Events/delete.php";
Users\Events\delete($mysqli, $user, $event);

unset($_SESSION['calendar/all-events/errors']);
$_SESSION['calendar/all-events/messages'] = ["Event #$id has been deleted."];

include_once "$fnsDir/redirect.php";
include_once "$fnsDir/ItemList/listUrl.php";
redirect(ItemList\listUrl());
