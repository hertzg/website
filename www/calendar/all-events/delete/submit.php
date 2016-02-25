<?php

include_once '../../../../lib/defaults.php';

$fnsDir = '../../../fns';

include_once "$fnsDir/require_same_domain_referer.php";
require_same_domain_referer('..');

include_once '../fns/require_event.php';
include_once '../../../lib/mysqli.php';
list($event, $id, $user) = require_event($mysqli);

include_once "$fnsDir/Users/Events/delete.php";
Users\Events\delete($mysqli, $user, $event);

include_once "$fnsDir/redirect.php";

$messages = ["Event #$id has been deleted."];
if ($user->num_events > 1) {
    unset($_SESSION['calendar/all-events/errors']);
    $_SESSION['calendar/all-events/messages'] = $messages;
    include_once "$fnsDir/ItemList/listUrl.php";
    redirect(ItemList\listUrl());
}

$messages[] = 'No more events.';
unset($_SESSION['calendar/errors']);
$_SESSION['calendar/messages'] = $messages;
redirect('../../');
