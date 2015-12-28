<?php

$fnsDir = '../../fns';

include_once "$fnsDir/signed_user.php";
$user = signed_user();

include_once "$fnsDir/Page/create.php";
include_once "$fnsDir/Page/errors.php";
include_once "$fnsDir/Page/imageLink.php";
$content = Page\create(
    [
        'title' => 'Help',
        'href' => '../#install-link-handlers',
    ],
    'Install Link Handlers',
    '<noscript>'
        .Page\errors(['We\'re sorry. The link handlers cannot be installed'
            .' without enabling JavaScript in your web browser.'])
    .'</noscript>'
    .'<div id="jsContent" style="display: none">'
        .Page\imageLink('mailto: Link', '', 'protocol', ['id' => 'mailto'])
        .'<div class="hr"></div>'
        .Page\imageLink('sms: Link', '', 'protocol', ['id' => 'sms'])
        .'<div class="hr"></div>'
        .Page\imageLink('tel: Link', '', 'protocol', ['id' => 'tel'])
    .'</div>'
    .'<script type="text/javascript" src="index.js?2" async="true"></script>'
);

include_once "$fnsDir/echo_public_page.php";
echo_public_page($user, 'Help', $content, '../../');
