<?php

include_once '../../fns/signed_user.php';
$user = signed_user();

include_once '../../fns/Page/errors.php';
include_once '../../fns/Page/imageLink.php';
include_once '../../fns/Page/tabs.php';
include_once '../../fns/Page/text.php';
$content = Page\tabs(
    [
        [
            'title' => 'Help',
            'href' => '../#install',
        ],
    ],
    'Install Zvini App',
    '<noscript>'
        .Page\errors(['We\'re sorry. The link handlers cannot be installed'
            .' without enabling JavaScript in your web browser.'])
    .'</noscript>'
    .'<div id="jsContent" style="display: none">'
        .Page\imageLink('mailto: Link', '', 'TODO', ['id' => 'mailto'])
        .'<div class="hr"></div>'
        .Page\imageLink('sms: Link', '', 'TODO', ['id' => 'sms'])
        .'<div class="hr"></div>'
        .Page\imageLink('tel: Link', '', 'TODO', ['id' => 'tel'])
    .'</div>'
    .'<script type="text/javascript" src="index.js?2" async="true"></script>'
);

include_once '../../fns/echo_page.php';
echo_page($user, 'Help', $content, '../../');
