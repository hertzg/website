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
include_once "$fnsDir/Page/phpCode.php";
include_once "$fnsDir/Page/tabs.php";
$content = Page\tabs(
    [
        [
            'title' => 'Administration',
            'href' => '../#ensure-crontab',
        ],
    ],
    'Ensure Crontab',
    $status.Page\phpCode(join("\n", get_crontab_lines()))
);

include_once "$fnsDir/echo_guest_page.php";
echo_guest_page('Administration', $content, '../../');
