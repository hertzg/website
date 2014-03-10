<?php

include_once '../../fns/require_same_domain_referer.php';
require_same_domain_referer('..');

include_once '../fns/require_event.php';
include_once '../../lib/mysqli.php';
list($event, $idevents, $user) = require_event($mysqli);

include_once '../../fns/Events/delete.php';
Events\delete($mysqli, $idevents);

include_once '../../fns/Users/addNumEvents.php';
Users\addNumEvents($mysqli, $user->idusers, -1);

$_SESSION['calendar/index_messages'] = array('Event has been deleted.');

include_once '../../fns/redirect.php';
redirect('../?'.http_build_query(array(
    'year' => date('Y', $event->eventtime),
    'month' => date('n', $event->eventtime),
    'day' => date('d', $event->eventtime),
)));
