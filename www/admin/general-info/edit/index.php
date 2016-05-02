<?php

include_once '../../../../lib/defaults.php';

include_once '../../fns/require_admin.php';
$admin_user = require_admin();

$fnsDir = '../../../fns';

unset($_SESSION['admin/general-info/messages']);

$key = 'admin/general-info/edit/values';
if (array_key_exists($key, $_SESSION)) $values = $_SESSION[$key];
else {
    include_once "$fnsDir/DomainName/get.php";
    include_once "$fnsDir/InfoEmail/get.php";
    include_once "$fnsDir/NumReverseProxies/get.php";
    include_once "$fnsDir/SignUpEnabled/get.php";
    include_once "$fnsDir/SiteBase/get.php";
    include_once "$fnsDir/SiteProtocol/get.php";
    include_once "$fnsDir/SiteTitle/get.php";
    $values = [
        'focus' => 'siteTitle',
        'siteTitle' => SiteTitle\get(),
        'domainName' => DomainName\get(),
        'infoEmail' => InfoEmail\get(),
        'siteBase' => SiteBase\get(),
        'numReverseProxies' => NumReverseProxies\get(),
        'https' => SiteProtocol\get() === 'https',
        'signupEnabled' => SignUpEnabled\get(),
    ];
}

$focus = $values['focus'];

include_once "$fnsDir/Form/button.php";
include_once "$fnsDir/Form/checkbox.php";
include_once "$fnsDir/Form/notes.php";
include_once "$fnsDir/Form/select.php";
include_once "$fnsDir/Form/textfield.php";
include_once "$fnsDir/NumReverseProxies/available.php";
include_once "$fnsDir/Page/create.php";
include_once "$fnsDir/Page/sessionErrors.php";
$content = Page\create(
    [
        'title' => 'General Information',
        'href' => '../#edit',
    ],
    'Edit',
    Page\sessionErrors('admin/general-info/edit/errors')
    .'<form action="submit.php" method="post">'
        .Form\textfield('siteTitle', 'Site title', [
            'value' => $values['siteTitle'],
            'autofocus' => $focus === 'siteTitle',
            'required' => true,
        ])
        .'<div class="hr"></div>'
        .Form\textfield('domainName', 'Domain name', [
            'value' => $values['domainName'],
            'autofocus' => $focus === 'domainName',
            'required' => true,
        ])
        .'<div class="hr"></div>'
        .Form\textfield('infoEmail', 'Informational email', [
            'value' => $values['infoEmail'],
            'autofocus' => $focus === 'infoEmail',
            'required' => true,
        ])
        .'<div class="hr"></div>'
        .Form\textfield('siteBase', 'Website path', [
            'value' => $values['siteBase'],
            'autofocus' => $focus === 'siteBase',
            'required' => true,
        ])
        .'<div class="hr"></div>'
        .Form\select('numReverseProxies', 'Reverse proxies / your IP',
            NumReverseProxies\available(), $values['numReverseProxies'],
            $focus === 'numReverseProxies')
        .Form\notes([
            'The number of reverse proxy servers that the Zvini instance'
            .' is behind and your IP address detected by that configuration.',
        ])
        .'<div class="hr"></div>'
        .Form\checkbox('https', 'Uses HTTPS', $values['https'])
        .'<div class="hr"></div>'
        .Form\checkbox('signupEnabled',
            'Anyone can create an account', $values['signupEnabled'])
        .Form\button('Save Changes', null, $focus === 'button')
    .'</form>'
);

include_once '../../fns/echo_admin_page.php';
include_once "$fnsDir/compressed_js_script.php";
echo_admin_page($admin_user, 'Edit General Information', $content, '../../', [
    'scripts' => compressed_js_script('formCheckbox', '../../../'),
]);
