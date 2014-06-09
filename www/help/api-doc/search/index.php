<?php

$base = '../../../';

include_once '../../../fns/require_user.php';
$user = require_user($base);

include_once '../../../fns/request_strings.php';
list($keyword) = request_strings('keyword');

include_once '../../../fns/str_collapse_spaces.php';
$keyword = str_collapse_spaces($keyword);

if ($keyword === '') {
    include_once '../../../fns/redirect.php';
    redirect('..');
}

include_once '../../../fns/Page/tabs.php';
include_once '../../../fns/SearchForm/content.php';
include_once '../../../fns/SearchForm/create.php';
$content = Page\tabs(
    [
        [
            'title' => '&middot;&middot;&middot;',
            'href' => '../../../home/'
        ],
        [
            'title' => 'Help',
            'href' => '../..',
        ],
    ],
    'API Documentation',
    SearchForm\create('./', SearchForm\content($keyword, 'Search...', '..'))
);

include_once '../../../fns/echo_page.php';
echo_page($user, 'Search API Documentation', $content, $base);
