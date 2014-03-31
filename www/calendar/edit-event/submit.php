<?php

include_once '../../fns/require_same_domain_referer.php';
require_same_domain_referer('..');

include_once '../fns/require_event.php';
include_once '../../lib/mysqli.php';
list($event, $id_events, $user) = require_event($mysqli);

include_once '../../fns/request_strings.php';
list($event_text) = request_strings('event_text');

include_once '../../fns/str_collapse_spaces.php';
$event_text = str_collapse_spaces($event_text);

$errors = [];

if ($event_text === '') $errors[] = 'Enter text.';

include_once '../../fns/redirect.php';

if ($errors) {
    $_SESSION['calendar/edit-event/errors'] = $errors;
    $_SESSION['calendar/edit-event/values'] = [
        'event_text' => $event_text,
    ];
    redirect("./?id_events=$id_events");
}

unset($_SESSION['calendar/edit-event/errors']);

include_once '../../fns/Events/edit.php';
Events\edit($mysqli, $user->id_users, $id_events, $event_text);

$_SESSION['calendar/view-event/messages'] = ['Changes have been saved.'];

redirect("../view-event/?id_events=$id_events");
