<?php

include_once '../../../../lib/defaults.php';

$fnsDir = '../../../fns';

include_once "$fnsDir/signed_user.php";
$user = signed_user();

include_once 'fns/get_methods.php';
$methods = get_methods();

$items = [];
include_once "$fnsDir/Page/imageArrowLinkWithDescription.php";
foreach ($methods as $name => $description) {
    $items[] = Page\imageArrowLinkWithDescription($name,
        $description, "$name/", 'api-method', ['id' => $name]);
}

include_once 'fns/get_article_text.php';
include_once "$fnsDir/create_panel.php";
include_once "$fnsDir/Page/create.php";
include_once "$fnsDir/Page/imageArrowLink.php";
include_once "$fnsDir/Page/text.php";
$content =
    Page\create(
        [
            'title' => 'Help',
            'href' => '../#exchange-api-doc',
            'localNavigation' => true,
        ],
        'Exchange API Documentation',
        Page\text(get_article_text())
        .'<div class="hr"></div>'
        .Page\imageArrowLink('PHP Example',
            'php-example', 'generic', ['id' => 'php-example'])
        .'<div class="hr"></div>'
        .Page\text(
            'Below is a list of errors that'
            .' are expected from any exchange API method:'
            .'<br /><code>INVALID_EXCHANGE_API_KEY</code> - '
            .'The exchange API key is invalid.'
            .'<br /><code>EXCHANGE_API_KEY_EXPIRED</code> - '
            .'The exchange API key is expired.'
        )
    )
    .create_panel('Methods', join('<div class="hr"></div>', $items));

include_once '../../fns/echo_admin_page.php';
echo_admin_page($user, 'Exchange API Documentation', $content, '../../');
