<?php

include_once '../../fns/require_same_domain_referer.php';
require_same_domain_referer('..');

include_once '../fns/require_event.php';
include_once '../../lib/mysqli.php';
list($event, $id, $user) = require_event($mysqli);
$event_time = $event->event_time;

include_once '../../fns/Events/delete.php';
Events\delete($mysqli, $id);

include_once '../../fns/Users/addNumEvents.php';
Users\addNumEvents($mysqli, $user->id_users, -1);

include_once '../../fns/Users/Events/invalidateIfNeeded.php';
Users\Events\invalidateIfNeeded($mysqli, $user, $event_time);

unset($_SESSION['calendar/errors']);
$_SESSION['calendar/messages'] = ['Event has been deleted.'];

include_once '../../fns/redirect.php';
redirect('../?'.http_build_query([
    'year' => date('Y', $event_time),
    'month' => date('n', $event_time),
    'day' => date('d', $event_time),
]));
