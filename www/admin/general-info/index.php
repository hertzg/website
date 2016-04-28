<?php

include_once '../../../lib/defaults.php';

include_once '../fns/require_admin.php';
$admin_user = require_admin();

$fnsDir = '../../fns';

include_once "$fnsDir/Page/imageArrowLink.php";
$editLink = Page\imageArrowLink('Edit', 'edit/', 'generic', ['id' => 'edit']);

include_once "$fnsDir/SiteProtocol/get.php";
$https = SiteProtocol\get() === 'https' ? 'Yes' : 'No';

unset(
    $_SESSION['admin/general-info/edit/errors'],
    $_SESSION['admin/general-info/edit/values']
);

include_once "$fnsDir/get_client_address.php";
$client_address = get_client_address();

if ($client_address === false) {
    include_once "$fnsDir/Page/errors.php";
    $error = 'With this settings a client IP address cannot be detected.';
    $errors = Page\errors([$error]);
    $yourIp = '<span class="colorText red">cannot be detected</span>';
} else {
    $errors = '';
    $yourIp = htmlspecialchars($client_address);
}

include_once "$fnsDir/Page/panel.php";
include_once "$fnsDir/DomainName/get.php";
include_once "$fnsDir/Form/label.php";
include_once "$fnsDir/Form/notes.php";
include_once "$fnsDir/InfoEmail/get.php";
include_once "$fnsDir/NumReverseProxies/get.php";
include_once "$fnsDir/Page/create.php";
include_once "$fnsDir/Page/sessionMessages.php";
include_once "$fnsDir/SignUpEnabled/get.php";
include_once "$fnsDir/SiteTitle/get.php";
$content =
    Page\create(
        [
            'title' => 'Administration',
            'href' => '../#general-info',
        ],
        'General Information',
        Page\sessionMessages('admin/general-info/messages')
        .$errors
        .Form\label('Site title', htmlspecialchars(SiteTitle\get()))
        .'<div class="hr"></div>'
        .Form\label('Domain name', DomainName\get())
        .'<div class="hr"></div>'
        .Form\label('Informational email', InfoEmail\get())
        .'<div class="hr"></div>'
        .Form\label('Website path', htmlspecialchars(SiteBase\get()))
        .'<div class="hr"></div>'
        .Form\label('Reverse proxies / your IP',
            NumReverseProxies\get()." / $yourIp")
        .Form\notes([
            'The number of reverse proxy servers that the Zvini instance'
            .' is behind and your IP address detected by that configuration.',
        ])
        .'<div class="hr"></div>'
        .Form\label('Uses HTTPS', $https)
        .'<div class="hr"></div>'
        .Form\label('Anyone can create an account',
            SignUpEnabled\get() ? 'Yes' : 'No')
    )
    .Page\panel('Options', $editLink);

include_once '../fns/echo_admin_page.php';
echo_admin_page($admin_user, 'General Information', $content, '../');
