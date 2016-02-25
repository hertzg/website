<?php

include_once '../../../../lib/defaults.php';

include_once 'fns/require_tokens.php';
$user = require_tokens();

$base = '../../../';
$fnsDir = '../../../fns';

unset(
    $_SESSION['account/tokens/errors'],
    $_SESSION['account/tokens/messages']
);

include_once '../fns/create_page.php';
include_once '../../../lib/mysqli.php';
$content = create_page($mysqli, $user, $scripts, '../');

include_once "$fnsDir/Page/confirmDialog.php";
$content .= Page\confirmDialog(
    'Are you sure you want to delete all the remembered sessions?',
    'Yes, delete all sessions', 'submit.php', '..');

include_once "$fnsDir/compressed_css_link.php";
include_once "$fnsDir/echo_user_page.php";
echo_user_page($user, 'Delete All Remembered Sessions?', $content, $base, [
    'head' => compressed_css_link('confirmDialog', $base),
    'scripts' => $scripts,
]);
