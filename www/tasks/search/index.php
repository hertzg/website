<?php

include_once '../../../lib/defaults.php';

include_once '../fns/require_tasks.php';
$user = require_tasks();

$fnsDir = '../../fns';

include_once '../fns/SearchPage/create.php';
include_once '../../lib/mysqli.php';
$content = SearchPage\create($mysqli, $user, $scripts);

if ($user->num_tasks) {
    include_once "$fnsDir/delete_all_confirm_dialog.php";
    delete_all_confirm_dialog($head, $scripts, '../');
} else {
    $head = '';
}

include_once "$fnsDir/echo_user_page.php";
echo_user_page($user, 'Tasks', $content, '../../', [
    'head' => $head,
    'scripts' => $scripts,
]);
