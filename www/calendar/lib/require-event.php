<?php

include_once 'require-user.php';
include_once __DIR__.'/../../fns/request_strings.php';
include_once __DIR__.'/../../classes/Events.php';
list($idevents) = request_strings('idevents');
$idevents = abs((int)$idevents);
$event = Events::get($idusers, $idevents);
if (!$event) {
    include_once __DIR__.'/../../fns/redirect.php';
    redirect();
}
