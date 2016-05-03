<?php

include_once '../../../lib/defaults.php';

include_once '../fns/require_admin.php';
$admin_user = require_admin();

unset($_SESSION['admin/messages']);

$fnsDir = '../../fns';

exec('git describe', $lines);
if (count($lines) === 1) $current_version = htmlspecialchars($lines[0]);
else $current_version = 'Not available';
unset($lines);

exec('git describe origin/master', $lines);
if (count($lines) === 1) $latest_version = htmlspecialchars($lines[0]);
else $latest_version = 'Not available';
unset($lines);

include_once "$fnsDir/Form/linkButton.php";

if ($current_version !== $latest_version) {
    include_once "$fnsDir/Page/panel.php";
    include_once "$fnsDir/Page/text.php";
    $updatePanel = Page\panel(
        'Update to the Latest Version',
        Page\text(
            'Before you proceed, please, make sure:<br />'
            .' &bull; You have a backup copy of the website.<br />'
            .' &bull; The PHP process has read/write access'
            .' to all the source files of the website.<br />'
        )
        .Form\linkButton('Update', 'submit-update.php', true)
    );
} else {
    $updatePanel = '';
}

include_once "$fnsDir/Form/label.php";
include_once "$fnsDir/Page/create.php";
$content = Page\create(
    [
        'title' => 'Administration',
        'href' => '../#update',
    ],
    'Software Update',
    Form\label('Current version', $current_version)
    .'<div class="hr"></div>'
    .Form\label('Latest version', $latest_version)
    .Form\linkButton('Check for Updates', 'submit-check.php', true)
    .$updatePanel
);

include_once '../fns/echo_admin_page.php';
echo_admin_page($admin_user, 'Users', $content, '../');
