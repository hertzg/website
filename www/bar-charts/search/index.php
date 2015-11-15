<?php

include_once '../fns/require_bar_charts.php';
$user = require_bar_charts();

$fnsDir = '../../fns';

include_once '../fns/SearchPage/create.php';
include_once '../../lib/mysqli.php';
$content = SearchPage\create($mysqli, $user, $scripts);

if ($user->num_bar_charts) {
    include_once "$fnsDir/delete_all_confirm_dialog.php";
    $content .= delete_all_confirm_dialog($head, '../');
} else {
    $head = '';
}

include_once "$fnsDir/echo_user_page.php";
echo_user_page($user, 'Bar Charts', $content, '../../', [
    'head' => $head,
    'scripts' => $scripts,
]);
