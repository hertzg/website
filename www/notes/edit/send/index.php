<?php

include_once 'fns/require_stage.php';
include_once '../../../lib/mysqli.php';
list($user, $stageValues, $id) = require_stage($mysqli);

$key = 'notes/edit/send/values';
if (array_key_exists($key, $_SESSION)) $values = $_SESSION[$key];
else $values = ['username' => ''];

include_once '../../../fns/ItemList/escapedItemQuery.php';
$escapedItemQuery = ItemList\escapedItemQuery($id);

include_once '../../../fns/ItemList/itemParams.php';
$itemParams = ItemList\itemParams($id);

include_once '../../../fns/Page/itemSendForm.php';
include_once '../../../fns/Page/sessionErrors.php';
include_once '../../../fns/Page/tabs.php';
include_once '../../../fns/Page/warnings.php';
$content = Page\tabs(
    [
        [
            'title' => '&middot;&middot;&middot;',
            'href' => "../../view/$escapedItemQuery",
        ],
        [
            'title' => 'Edit',
            'href' => "../$escapedItemQuery",
        ],
    ],
    'Send',
    Page\sessionErrors('notes/edit/send/errors')
    .Page\warnings(['Send the edited note to:'])
    .Page\itemSendForm($mysqli, $user->id_users,
        $values['username'], $itemParams)
);

include_once '../../../fns/echo_page.php';
echo_page($user, 'Send Edited Note', $content, '../../../');
