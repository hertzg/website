<?php

$fnsDir = '../../../fns';

include_once "$fnsDir/require_same_domain_referer.php";
require_same_domain_referer('./');

include_once "$fnsDir/require_user.php";
$user = require_user('../../../');

include_once '../../fns/request_event_params.php';
list($event_day, $event_month,
    $event_year, $event_time, $text) = request_event_params($errors);

include_once "$fnsDir/redirect.php";

if ($errors) {
    $_SESSION['calendar/all-events/new/errors'] = $errors;
    $_SESSION['calendar/all-events/new/values'] = [
        'event_day' => $event_day,
        'event_month' => $event_month,
        'event_year' => $event_year,
        'text' => $text,
    ];
    include_once "$fnsDir/ItemList/pageQuery.php";
    redirect('./'.ItemList\pageQuery());
}

unset(
    $_SESSION['calendar/all-events/new/errors'],
    $_SESSION['calendar/all-events/new/values']
);

include_once "$fnsDir/Users/Events/add.php";
include_once '../../../lib/mysqli.php';
$id = Users\Events\add($mysqli, $user, $text, $event_time);

$_SESSION['calendar/all-events/view/messages'] = ['Event has been saved.'];

include_once "$fnsDir/ItemList/itemQuery.php";
redirect('../view/'.ItemList\itemQuery($id));
