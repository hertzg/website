<?php

include_once '../../../../lib/defaults.php';

include_once 'fns/require_stage.php';
include_once '../../../lib/mysqli.php';
list($user, $stageValues, $id) = require_stage($mysqli);

$base = '../../../';

include_once '../../../fns/SendForm/EditItem/recipientsPage.php';
SendForm\EditItem\recipientsPage($mysqli, $user, $id, 'Send Edited Bookmark',
    'bookmark', 'bookmarks/edit/send/errors',
    'bookmarks/edit/send/messages', 'bookmarks/edit/send/values',
    $base, "{$base}contacts/");
