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

include_once "$fnsDir/ClientAddress/get.php";
$client_address = ClientAddress\get();

if ($client_address === false) {
    include_once "$fnsDir/Page/errors.php";
    $error = 'With this settings a client IP address cannot be detected.';
    $errors = Page\errors([$error]);
    $yourAddress = 'Cannot be detected';
} else {
    $errors = '';
    $yourAddress = htmlspecialchars($client_address);
}

include_once "$fnsDir/create_panel.php";
include_once "$fnsDir/DomainName/get.php";
include_once "$fnsDir/Form/label.php";
include_once "$fnsDir/InfoEmail/get.php";
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
        .Form\label('Uses HTTPS', $https)
        .'<div class="hr"></div>'
        .Form\label('Behind reverse proxy', $behindProxy)
        .'<div class="hr"></div>'
        .Form\label('Anyone can create an account',
            SignUpEnabled\get() ? 'Yes' : 'No')
        .'<div class="hr"></div>'
        .Form\label('Your IP address', $yourAddress)
    )
    .create_panel('Options', $editLink);

include_once '../fns/echo_admin_page.php';
echo_admin_page('General Information', $content, '../');
