<?php

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
    ],
    'Install Zvini App',
    '<noscript>'
        .Page\errors(['We\'re sorry. Zvini app cannot be installed'
            .' without enabling JavaScript in your web browser.'])
    .'</noscript>'
    .'<div id="installingMessage" style="display: none">'
        .Page\text('Please wait...')
    .'</div>'
    .'<script type="text/javascript" src="index.js?4" async="true"></script>'
);

include_once "$fnsDir/echo_public_page.php";
echo_public_page($user, 'Install Zvini App', $content, '../../');
