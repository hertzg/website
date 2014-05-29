<?php

include_once '../../fns/require_same_domain_referer.php';
require_same_domain_referer('..');

include_once '../fns/require_note.php';
include_once '../../lib/mysqli.php';
list($note, $id, $user) = require_note($mysqli);

include_once '../../fns/Users/Notes/delete.php';
Users\Notes\delete($mysqli, $note);

unset($_SESSION['notes/errors']);
$_SESSION['notes/messages'] = ['Note has been deleted.'];

include_once '../../fns/redirect.php';
include_once '../../fns/ItemList/listUrl.php';
redirect(ItemList\listUrl());
