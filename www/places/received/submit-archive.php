<?php

include_once '../../../lib/defaults.php';

$fnsDir = '../../fns';

include_once "$fnsDir/require_same_domain_referer.php";
require_same_domain_referer('./');

include_once 'fns/require_received_place.php';
include_once '../../lib/mysqli.php';
list($receivedPlace, $id, $user) = require_received_place($mysqli);

include_once "$fnsDir/Users/Places/Received/archive.php";
Users\Places\Received\archive($mysqli, $receivedPlace);

$_SESSION['places/received/view/messages'] = ['Place has been archived.'];

include_once "$fnsDir/redirect.php";
include_once "$fnsDir/ItemList/Received/itemQuery.php";
redirect('view/'.ItemList\Received\itemQuery($id));
