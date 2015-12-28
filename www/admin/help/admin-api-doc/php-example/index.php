<?php

$fnsDir = '../../../../fns';

include_once 'fns/get_code.php';
include_once "$fnsDir/Page/create.php";
include_once "$fnsDir/Page/sourceCode.php";
include_once "$fnsDir/Page/text.php";
$content = Page\create(
    [
        'title' => 'Admin API Documentation',
        'href' => '../#php-example',
    ],
    'PHP Example',
    Page\text('Below is a PHP code that calls an example admin API method:')
    .'<div class="hr"></div>'
    .Page\sourceCode(get_code())
);

include_once '../../../fns/echo_admin_page.php';
echo_admin_page('PHP Example', $content, '../../../');
