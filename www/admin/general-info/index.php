<?php

include_once '../fns/require_admin.php';
require_admin();

$fnsDir = '../../fns';

include_once "$fnsDir/Page/imageArrowLink.php";
$editLink = Page\imageArrowLink('Edit', 'edit/', 'generic', ['id' => 'edit']);

include_once "$fnsDir/SiteProtocol/get.php";
$https = SiteProtocol\get() === 'https' ? 'Yes' : 'No';

include_once "$fnsDir/ClientAddress/GetMethod/get.php";
$behindProxy = ClientAddress\GetMethod\get() == 'behind_proxy' ? 'Yes' : 'No';

unset(
    $_SESSION['admin/general-info/edit/errors'],
    $_SESSION['admin/general-info/edit/values']
);

include_once "$fnsDir/create_panel.php";
include_once "$fnsDir/DomainName/get.php";
include_once "$fnsDir/Form/label.php";
include_once "$fnsDir/InfoEmail/get.php";
include_once "$fnsDir/Page/sessionMessages.php";
include_once "$fnsDir/Page/tabs.php";
include_once "$fnsDir/SiteTitle/get.php";
$content = Page\tabs(
    [
        [
            'title' => 'Administration',
            'href' => '../#general-info',
        ],
    ],
    'General Information',
    Page\sessionMessages('admin/general-info/messages')
    .Form\label('Site title', htmlspecialchars(SiteTitle\get()))
    .'<div class="hr"></div>'
    .Form\label('Domain name', DomainName\get())
    .'<div class="hr"></div>'
    .Form\label('Informational email', InfoEmail\get())
    .'<div class="hr"></div>'
    .Form\label('Path to "www" folder', htmlspecialchars(SiteBase\get()))
    .'<div class="hr"></div>'
    .Form\label('Uses HTTPS', $https)
    .'<div class="hr"></div>'
    .Form\label('Behind reverse proxy', $behindProxy)
    .create_panel('Options', $editLink)
);

include_once "$fnsDir/echo_guest_page.php";
echo_guest_page('General Information', $content, '../../');
