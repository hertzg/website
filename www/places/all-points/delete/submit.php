<?php

include_once '../../../../lib/defaults.php';

$fnsDir = '../../../fns';

include_once "$fnsDir/require_same_domain_referer.php";
require_same_domain_referer('..');

include_once '../../fns/require_point.php';
include_once '../../../lib/mysqli.php';
list($point, $id, $user, $place) = require_point($mysqli, '../');

if ($place->num_points > 1) {
    include_once "$fnsDir/Users/Places/Points/delete.php";
    Users\Places\Points\delete($mysqli, $point);
}

$id_places = $point->id_places;

include_once "$fnsDir/redirect.php";

$messages = ["Point #$id has been deleted."];
if ($place->num_points > 2) {
    $_SESSION['places/all-points/messages'] = $messages;
    include_once "$fnsDir/ItemList/itemQuery.php";
    redirect('../'.ItemList\itemQuery($id_places));
}

$messages[] = 'No more points.';
$_SESSION['places/view/messages'] = $messages;
redirect("../../view/?id=$id_places");
