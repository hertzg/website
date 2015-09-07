<?php

include_once '../fns/require_tasks.php';
$user = require_tasks();

$fnsDir = '../../fns';

include_once '../fns/SearchPage/create.php';
include_once '../../lib/mysqli.php';
$content = SearchPage\create($mysqli, $user);

if ($user->num_tasks) {
    include_once "$fnsDir/delete_all_confirm_dialog.php";
    $content .= delete_all_confirm_dialog($head, '../');
} else {
    $head = '';
}

include_once "$fnsDir/echo_user_page.php";
echo_user_page($user, 'Tasks', $content, '../../', ['head' => $head]);
