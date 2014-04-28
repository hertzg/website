<?php

function highlight ($string) {
    $string = htmlspecialchars($string);
    $replace = '$1<span class="comment">$2</span>$3';
    $string = preg_replace('/(^|\n)(\/\/.*)(\n|$)/', $replace, $string);
    $replace = '<span class="string">$0</span>';
    $string = preg_replace('/\'.*?\'/', $replace, $string);
    return $string;
}

$base = '../../../';

include_once '../../../fns/require_user.php';
$user = require_user($base);

$api_base = 'https://zvini.com/api-call/';

include_once '../../../fns/Page/phpCode.php';
include_once '../../../fns/Page/tabs.php';
include_once '../../../fns/Page/text.php';
$content = Page\tabs(
    [
        [
            'title' => '&middot;&middot;&middot;',
            'href' => '../..',
        ],
        [
            'title' => 'API Documentation',
            'href' => '..',
        ],
    ],
    'PHP Example',
    Page\text('Below is a PHP code that calls an example method:')
    .'<div class="hr"></div>'
    .Page\phpCode(
        highlight(file_get_contents('code'))
    )
);

include_once '../../../fns/echo_page.php';
echo_page($user, 'PHP Example', $content, $base);
