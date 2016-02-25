<?php

include_once '../../../../lib/defaults.php';

$fnsDir = '../../../fns';

include_once "$fnsDir/signed_user.php";
$user = signed_user();

include_once 'fns/get_code.php';
include_once "$fnsDir/Page/create.php";
include_once "$fnsDir/Page/sourceCode.php";
include_once "$fnsDir/Page/text.php";
$content = Page\create(
    [
        'title' => 'API Documentation',
        'href' => '../#php-example',
    ],
    'PHP Example',
    Page\text('Below is a PHP code that calls an example API method:')
    .'<div class="hr"></div>'
    .Page\sourceCode(get_code())
);

include_once "$fnsDir/echo_public_page.php";
echo_public_page($user, 'PHP Example', $content, '../../../');
