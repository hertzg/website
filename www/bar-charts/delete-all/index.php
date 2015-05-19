<?php

include_once '../fns/require_bar_charts.php';
$user = require_bar_charts();

unset(
    $_SESSION['bar-charts/errors'],
    $_SESSION['bar-charts/messages']
);

$base = '../../';
$fnsDir = '../../fns';

include_once '../fns/create_page.php';
include_once "$fnsDir/Page/confirmDialog.php";
include_once '../../lib/mysqli.php';
$content =
    create_page($mysqli, $user, '../')
    .Page\confirmDialog(
        'Are you sure you want to delete all the bar charts?'
        .' They will be moved to Trash.',
        'Yes, delete all bar charts', 'submit.php', '../');

include_once "$fnsDir/compressed_css_link.php";
include_once "$fnsDir/echo_page.php";
echo_page($user, 'Delete All Bar Charts?', $content, $base, [
    'head' => compressed_css_link('confirmDialog', $base),
]);
