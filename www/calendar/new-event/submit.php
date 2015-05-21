<?php

$fnsDir = '../../fns';

include_once "$fnsDir/require_same_domain_referer.php";
require_same_domain_referer('./');

include_once "$fnsDir/require_user.php";
$user = require_user('../../');

include_once '../fns/request_event_params.php';
$values = request_event_params($errors);
list($event_day, $event_month, $event_year, $event_time, $text) = $values;

include_once "$fnsDir/redirect.php";

if ($errors) {
    $_SESSION['calendar/new-event/errors'] = $errors;
    $_SESSION['calendar/new-event/values'] = [
        'event_day' => $event_day,
        'event_month' => $event_month,
        'event_year' => $event_year,
        'text' => $text,
    ];
    redirect();
}

unset(
    $_SESSION['calendar/new-event/errors'],
    $_SESSION['calendar/new-event/values']
);

include_once "$fnsDir/Users/Events/add.php";
include_once '../../lib/mysqli.php';
$id = Users\Events\add($mysqli, $user, $text, $event_time);

$_SESSION['calendar/view-event/messages'] = ['Event has been saved.'];

redirect("../view-event/?id=$id");
