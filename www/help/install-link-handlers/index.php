<?php

include_once '../../../lib/defaults.php';

$fnsDir = '../../fns';

include_once "$fnsDir/signed_user.php";
$user = signed_user();

include_once "$fnsDir/Page/create.php";
include_once "$fnsDir/Page/errors.php";
include_once "$fnsDir/Page/imageLink.php";
include_once "$fnsDir/SiteTitle/get.php";
$content = Page\create(
    [
        'title' => 'Help',
        'href' => '../#install-link-handlers',
        'localNavigation' => true,
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
);

include_once "$fnsDir/echo_public_page.php";
echo_public_page($user, 'Install Link Handlers', $content, '../../', [
    'scripts' =>
        '<script type="text/javascript">'
            .'var siteTitle = '.json_encode(SiteTitle\get())
        .'</script>'
        .'<script type="text/javascript" src="index.js?3"></script>',
]);
