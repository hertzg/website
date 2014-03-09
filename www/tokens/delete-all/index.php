<?php

include_once '../../fns/require_user.php';
require_user('../../');

unset($_SESSION['tokens/index_messages']);

include_once '../../fns/Page/text.php';
$question = Page\text(
    'Are you sure you want to delete all the remembered sessions?'
);

include_once '../../fns/create_tabs.php';
include_once '../../fns/Page/imageLink.php';
$content =
    create_tabs(
        array(
            array(
                'title' => '&middot;&middot;&middot;',
                'href' => '../..',
            ),
            array(
                'title' => 'Account',
                'href' => '../../account/',
            ),
        ),
        'Sessions',
        $question.'<div class="hr"></div>'
        .Page\imageLink('Yes, delete all sessions', 'submit.php', 'yes')
        .'<div class="hr"></div>'
        .Page\imageLink('No, return back', '..', 'no')
    );

include_once '../../fns/echo_page.php';
echo_page($user, 'Delete All Remembered Sessions?', $content, '../../');
