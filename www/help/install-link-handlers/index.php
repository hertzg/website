<?php

include_once '../../fns/signed_user.php';
$user = signed_user();

include_once '../../fns/Page/errors.php';
include_once '../../fns/Page/imageLink.php';
include_once '../../fns/Page/tabs.php';
$content = Page\tabs(
    [
        [
            'title' => 'Help',
            'href' => '../#install-link-handlers',
        ],
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

include_once '../../fns/echo_page.php';
echo_page($user, 'Help', $content, '../../');
