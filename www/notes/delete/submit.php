<?php

include_once '../../../lib/defaults.php';

$fnsDir = '../../fns';

include_once "$fnsDir/require_same_domain_referer.php";
require_same_domain_referer('..');

include_once '../fns/require_note.php';
include_once '../../lib/mysqli.php';
list($note, $id, $user) = require_note($mysqli);

include_once "$fnsDir/Users/Notes/delete.php";
Users\Notes\delete($mysqli, $note);

unset($_SESSION['notes/errors']);
$_SESSION['notes/messages'] = ["Note #$id has been deleted."];

include_once "$fnsDir/redirect.php";
include_once "$fnsDir/ItemList/listUrl.php";
redirect(ItemList\listUrl());
