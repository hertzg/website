<?php

include_once '../../fns/require_same_domain_referer.php';
require_same_domain_referer('..');

include_once '../fns/require_event.php';
include_once '../../lib/mysqli.php';
list($event, $id, $user) = require_event($mysqli);
$id_users = $user->id_users;
$event_time = $event->event_time;

include_once '../../fns/Events/delete.php';
Events\delete($mysqli, $id);

include_once '../../fns/Users/addNumEvents.php';
Users\addNumEvents($mysqli, $id_users, -1);

include_once '../fns/invalidate_user_events.php';
invalidate_user_events($mysqli, $id_users, $event_time);

unset($_SESSION['calendar/errors']);
$_SESSION['calendar/messages'] = ['Event has been deleted.'];

include_once '../../fns/redirect.php';
redirect('../?'.http_build_query([
    'year' => date('Y', $event_time),
    'month' => date('n', $event_time),
    'day' => date('d', $event_time),
]));
