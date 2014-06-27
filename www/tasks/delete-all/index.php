<?php

$base = '../../';

include_once '../../fns/require_user.php';
$user = require_user($base);

unset(
    $_SESSION['tasks/errors'],
    $_SESSION['tasks/messages']
);

include_once '../../fns/ItemList/escapedPageQuery.php';
include_once '../../fns/Page/imageLink.php';
$href = 'submit.php'.ItemList\escapedPageQuery();
$yesLink = Page\imageLink('Yes, delete all task', $href, 'yes');

include_once '../../fns/ItemList/listHref.php';
$noLink = Page\imageLink('No, return back', ItemList\listHref(), 'no');

include_once '../../fns/Page/tabs.php';
include_once '../../fns/Page/text.php';
include_once '../../fns/Page/twoColumns.php';
$content = Page\tabs(
    [
        [
            'title' => 'Home',
            'href' => '../../home/',
        ],
    ],
    'Tasks',
    Page\text('Are you sure you want to delete all the tasks?'
        .' They will be moved to Trash.')
    .'<div class="hr"></div>'
    .Page\twoColumns($yesLink, $noLink)
);

include_once '../../fns/echo_page.php';
echo_page($user, 'Delete All Tasks?', $content, $base);
