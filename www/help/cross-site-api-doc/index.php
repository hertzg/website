<?php

include_once '../../../lib/defaults.php';

$fnsDir = '../../fns';

include_once "$fnsDir/signed_user.php";
$user = signed_user();

unset($_SESSION['help/messages']);

include_once "$fnsDir/Page/create.php";
include_once "$fnsDir/Page/text.php";
$content = Page\create(
    [
        'title' => 'Help',
        'href' => '../#cross-site-api-doc',
        'localNavigation' => true,
    ],
    'Cross-site API Documentation',
    Page\text('')
);

include_once "$fnsDir/echo_public_page.php";
echo_public_page($user, 'Cross-site API Documentation', $content, '../../');
