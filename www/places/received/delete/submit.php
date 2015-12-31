<?php

$fnsDir = '../../../fns';

include_once "$fnsDir/require_same_domain_referer.php";
require_same_domain_referer('../..');

include_once '../fns/require_received_place.php';
include_once '../../../lib/mysqli.php';
list($receivedPlace, $id, $user) = require_received_place($mysqli, '../');

include_once "$fnsDir/Users/Places/Received/delete.php";
Users\Places\Received\delete($mysqli, $receivedPlace);

$messages = ["Received place #$id has been deleted."];
include_once "$fnsDir/redirect.php";

if ($user->num_received_places == 1) {
    $messages[] = 'No more received places.';
    $_SESSION['places/messages'] = $messages;
    unset($_SESSION['places/errors']);
    redirect('../..');
}

unset($_SESSION['places/received/errors']);
$_SESSION['places/received/messages'] = $messages;

include_once "$fnsDir/ItemList/Received/listUrl.php";
redirect(ItemList\Received\listUrl('../'));
