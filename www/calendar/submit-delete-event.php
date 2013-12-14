<?php

include_once 'lib/require-event.php';
include_once '../fns/redirect.php';
include_once '../classes/Events.php';
Events::delete($idusers, $idevents);
$_SESSION['calendar/index_messages'] = array('Event has been deleted.');
redirect('./?'.http_build_query(array(
    'year' => date('Y', $event->eventtime),
    'month' => date('n', $event->eventtime),
    'day' => date('d', $event->eventtime),
)));
