<?php

include_once '../../fns/require_same_domain_referer.php';
require_same_domain_referer('..');

include_once '../fns/require_place.php';
include_once '../../lib/mysqli.php';
list($place, $id, $user) = require_place($mysqli);

include_once '../../fns/Users/Places/delete.php';
Users\Places\delete($mysqli, $place);

unset($_SESSION['places/errors']);
$_SESSION['places/messages'] = ['Place has been deleted.'];

include_once '../../fns/redirect.php';
include_once '../../fns/ItemList/listUrl.php';
redirect(ItemList\listUrl());
