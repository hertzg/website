<?php

include_once __DIR__.'/../../../fns/require_user.php';
require_user('../../');

include_once __DIR__.'/../../../fns/request_strings.php';
list($idevents) = request_strings('idevents');

$idevents = abs((int)$idevents);

include_once __DIR__.'/../../../classes/Events.php';
$event = Events::get($idusers, $idevents);

if (!$event) {
    include_once __DIR__.'/../../fns/redirect.php';
    redirect();
}
