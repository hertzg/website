<?php

include_once '../../../../lib/defaults.php';

include_once '../fns/require_received_schedules.php';
$user = require_received_schedules('../');

unset(
    $_SESSION['schedules/received/errors'],
    $_SESSION['schedules/received/messages']
);

$base = '../../../';
$fnsDir = '../../../fns';

include_once "$fnsDir/ItemList/Received/listHref.php";
$noHref = ItemList\Received\listHref('../');

include_once '../fns/create_page.php';
include_once "$fnsDir/Page/confirmDialog.php";
include_once '../../../lib/mysqli.php';
$content =
    create_page($mysqli, $user, $scripts, '../')
    .Page\confirmDialog('Are you sure you want to delete'
        .' all the received schedules? They will be moved to Trash.',
        'Yes, delete all schedules', 'submit.php', $noHref);

include_once "$fnsDir/compressed_css_link.php";
include_once "$fnsDir/echo_user_page.php";
echo_user_page($user, 'Delete All Received Schedules?', $content, $base, [
    'head' => compressed_css_link('confirmDialog', $base),
    'scripts' => $scripts,
]);
