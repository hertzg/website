<?php

$fnsDir = '../../../fns';

include_once 'fns/get_code.php';
include_once "$fnsDir/Page/phpCode.php";
include_once "$fnsDir/Page/tabs.php";
include_once "$fnsDir/Page/text.php";
$content = Page\tabs(
    [
        [
            'title' => 'Admin API Documentation',
            'href' => '../#php-example',
        ],
    ],
    'PHP Example',
    Page\text('Below is a PHP code that calls an example admin API method:')
    .'<div class="hr"></div>'
    .Page\phpCode(get_code())
);

include_once '../../fns/echo_admin_page.php';
echo_admin_page('PHP Example', $content, '../../');
