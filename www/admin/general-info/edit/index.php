<?php

include_once '../../fns/require_admin.php';
require_admin();

$base = '../../../';
$fnsDir = '../../../fns';

unset($_SESSION['admin/general-info/messages']);

$key = 'admin/general-info/edit/values';
if (array_key_exists($key, $_SESSION)) $values = $_SESSION[$key];
else {
    include_once "$fnsDir/ClientAddress/GetMethod/get.php";
    include_once "$fnsDir/DomainName/get.php";
    include_once "$fnsDir/InfoEmail/get.php";
    include_once "$fnsDir/SiteBase/get.php";
    include_once "$fnsDir/SiteProtocol/get.php";
    include_once "$fnsDir/SiteTitle/get.php";
    $values = [
        'siteTitle' => SiteTitle\get(),
        'domainName' => DomainName\get(),
        'infoEmail' => InfoEmail\get(),
        'siteBase' => SiteBase\get(),
        'https' => SiteProtocol\get() === 'https',
        'behindProxy' => ClientAddress\GetMethod\get() === 'behind_proxy',
    ];
}

include_once "$fnsDir/compressed_js_script.php";
include_once "$fnsDir/Form/button.php";
include_once "$fnsDir/Form/checkbox.php";
include_once "$fnsDir/Form/textfield.php";
include_once "$fnsDir/Page/sessionErrors.php";
include_once "$fnsDir/Page/tabs.php";
$content =
    Page\tabs(
        [
            [
                'title' => 'General Information',
                'href' => '../#edit',
            ],
        ],
        'Edit',
        Page\sessionErrors('admin/general-info/edit/errors')
        .'<form action="submit.php" method="post">'
            .Form\textfield('siteTitle', 'Site title', [
                'value' => $values['siteTitle'],
                'autofocus' => true,
                'required' => true,
            ])
            .'<div class="hr"></div>'
            .Form\textfield('domainName', 'Domain name', [
                'value' => $values['domainName'],
                'required' => true,
            ])
            .'<div class="hr"></div>'
            .Form\textfield('infoEmail', 'Informational email', [
                'value' => $values['infoEmail'],
                'required' => true,
            ])
            .'<div class="hr"></div>'
            .Form\textfield('siteBase', 'Path to "www" folder', [
                'value' => $values['siteBase'],
                'required' => true,
            ])
            .'<div class="hr"></div>'
            .Form\checkbox('https', 'Uses HTTPS', $values['https'])
            .'<div class="hr"></div>'
            .Form\checkbox('behindProxy',
                'Behind reverse proxy', $values['behindProxy'])
            .'<div class="hr"></div>'
            .Form\button('Save Changes')
        .'</form>'
    )
    .compressed_js_script('formCheckbox', $base);

include_once "$fnsDir/echo_guest_page.php";
echo_guest_page('Edit General Information', $content, $base);
