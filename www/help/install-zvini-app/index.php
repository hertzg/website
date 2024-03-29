<?php

include_once '../../../lib/defaults.php';

$fnsDir = '../../fns';

include_once "$fnsDir/signed_user.php";
$user = signed_user();

include_once "$fnsDir/Page/create.php";
include_once "$fnsDir/Page/errors.php";
include_once "$fnsDir/Page/text.php";
$content = Page\create(
    [
        'title' => 'Help',
        'href' => '../#install-zvini-app',
        'localNavigation' => true,
    ],
    'Install Zvini App',
    '<noscript>'
        .Page\errors(['We\'re sorry. Zvini app cannot be installed'
            .' without enabling JavaScript in your web browser.'])
    .'</noscript>'
    .'<div id="installingMessage" style="display: none">'
        .Page\text('Please wait...')
    .'</div>'
);

include_once "$fnsDir/echo_public_page.php";
echo_public_page($user, 'Install Zvini App', $content, '../../', [
    'scripts' => '<script type="text/javascript" src="index.js?5"></script>',
]);
