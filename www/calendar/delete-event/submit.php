<?php

include_once '../../lib/sameDomainReferer.php';
include_once '../../fns/redirect.php';
if (!$sameDomainReferer) redirect('..');
include_once 'lib/require-event.php';

include_once '../../fns/Events/delete.php';
include_once '../../lib/mysqli.php';
Events\delete($mysqli, $idevents);

$_SESSION['calendar/index_messages'] = array('Event has been deleted.');

redirect('../?'.http_build_query(array(
    'year' => date('Y', $event->eventtime),
    'month' => date('n', $event->eventtime),
    'day' => date('d', $event->eventtime),
)));
