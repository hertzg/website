<?php

include_once '../fns/require_admin.php';
require_admin();

$fnsDir = '../../fns';

include_once "$fnsDir/SiteProtocol/get.php";
$httpsProtocol = SiteProtocol\get() === 'https' ? 'Yes' : 'No';

include_once "$fnsDir/DomainName/get.php";
include_once "$fnsDir/Form/label.php";
include_once "$fnsDir/InfoEmail/get.php";
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
    Form\label('Site title', htmlspecialchars(SiteTitle\get()))
    .'<div class="hr"></div>'
    .Form\label('Domain name', DomainName\get())
    .'<div class="hr"></div>'
    .Form\label('Informational email', InfoEmail\get())
    .'<div class="hr"></div>'
    .Form\label('Path to "www" folder', htmlspecialchars(SiteBase\get()))
    .'<div class="hr"></div>'
    .Form\label('HTTPS protocol', $httpsProtocol)
);

include_once "$fnsDir/echo_guest_page.php";
echo_guest_page('General Information', $content, '../../');
