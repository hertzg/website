<?php

$fnsDir = '../../fns';

include_once "$fnsDir/require_same_domain_referer.php";
require_same_domain_referer('./');

include_once 'fns/require_received_place.php';
include_once '../../lib/mysqli.php';
list($receivedPlace, $id, $user) = require_received_place($mysqli);

include_once "$fnsDir/Users/Places/Received/import.php";
Users\Places\Received\import($mysqli, $receivedPlace);

$messages = ['Place has been imported.'];
include_once "$fnsDir/redirect.php";

if ($user->num_received_places == 1) {
    $messages[] = 'No more received places.';
    $_SESSION['places/messages'] = $messages;
    unset($_SESSION['places/errors']);
    redirect('..');
}

$_SESSION['places/received/messages'] = $messages;

include_once "$fnsDir/ItemList/Received/listUrl.php";
redirect(ItemList\Received\listUrl());
