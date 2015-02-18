<?php

include_once '../fns/require_point.php';
include_once '../../lib/mysqli.php';
list($point, $id, $user, $place) = require_point($mysqli);

$_SESSION['places/view/messages'] = ['The point has been removed.'];

if ($place->num_points > 1) {
    include_once '../../fns/Users/Places/Points/delete.php';
    Users\Places\Points\delete($mysqli, $point);
}

include_once '../../fns/redirect.php';
include_once '../../fns/ItemList/itemQuery.php';
redirect('../view/'.ItemList\itemQuery($place->id));