<?php

include_once '../fns/require_admin.php';
require_admin();

$fnsDir = '../../fns';

include_once "$fnsDir/write_crontab.php";
$ok = write_crontab();

if ($ok) {
    include_once "$fnsDir/Page/messages.php";
    $status = Page\messages(['The crontab has been written.']);
} else {
    include_once "$fnsDir/Page/errors.php";
    $status = Page\errors(['Failed to write the crontab.']);
}

include_once "$fnsDir/get_crontab_lines.php";
include_once "$fnsDir/Page/create.php";
include_once "$fnsDir/Page/sourceCode.php";
$content = Page\create(
    [
        'title' => 'Administration',
        'href' => '../#ensure-crontab',
    ],
    'Ensure Crontab',
    $status.Page\sourceCode(join("\n", get_crontab_lines()))
);

include_once '../fns/echo_admin_page.php';
echo_admin_page('Administration', $content, '../');
