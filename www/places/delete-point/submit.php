<?php

include_once '../fns/require_point.php';
include_once '../../lib/mysqli.php';
list($point, $id, $user, $place) = require_point($mysqli);

$_SESSION['places/view/messages'] = ['The point has been removed.'];

include_once '../../fns/redirect.php';
include_once '../../fns/ItemList/itemQuery.php';
redirect('../view/'.ItemList\itemQuery($place->id));
